<?php

namespace App\Console\Commands;

use App\Attendance;
use App\Calculation;
use App\User;
use DateInterval;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class CheckAttendance extends Command
{
	private $absence_time_lower;
	private $absence_time_upper;
	private $work_time_lower;
	private $work_time_upper;
	private $defective_time = 7.5 * 60;

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'check:attendance';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Print the unprocessed user\'s attendances to the console';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		// Get all users with attendances where they are not processed yet
		User::with([
			'attendances' => function ($query) { $query->where('is_processed', false); }
		])->get()->each(function ($user) {
			// If the user has unprocessed attendance
			if ($user->attendances->count() > 0)
			{
				// Get attendances data
				$data = $this->getAttendanceData($user->attendances);
				$calculations = new Collection;

				for ($i = 0; $i < count($data); $i++)
				{
					// Setup absence time and work time bounds using the attendance date
					$this->setDateBounds($data[$i]['date']);

					// If work is null, then the user is absent
					if ($data[$i]['work'] === null)
					{
						$calculations->push(new Calculation([
							'date' => $data[$i]['date']->format('Y-m-d'),
							'work_time' => 0,
							'absence_time' => $this->getTimeDifference($this->absence_time_lower, $this->absence_time_upper),
							'defective_time' => $this->defective_time,
							'user_id' => $user->id
						]));
					}
					// Otherwise
					else
					{
						// If the attendance date is the same as the previous one
						if ($i > 0 && $data[$i]['date']->isSameDay($data[$i - 1]['date']))
						{
							// Calculate the new values
							$last_calculation = $calculations->where('date', $data[$i]['date']->format('Y-m-d'))->first();
							$last_end_time = $data[$i - 1]['date'];
							$last_end_time->add($data[$i - 1]['work']);

							$start_time = $data[$i]['date'];
							$end_time = new DateTime($start_time);
							$end_time->add($data[$i]['work']);

							$work_time = $this->calculateWorkTime($start_time, $end_time, $this->work_time_lower, $this->work_time_upper);
							$absence_time = $this->calculateAbsenceTime($start_time, $end_time, $last_end_time, $this->absence_time_upper);

							// Update the last attendance values
							$last_calculation->fill([
								'work_time' => $last_calculation->work_time + $work_time,
								'absence_time' => $absence_time,
								'defective_time' => $last_calculation->defective_time - $work_time
							]);
						}
						// Otherwise
						else
						{
							// Calculate values
							$start_time = $data[$i]['date'];
							$end_time = new DateTime($start_time);
							$end_time->add($data[$i]['work']);

							$work_time = $this->calculateWorkTime($start_time, $end_time, $this->work_time_lower, $this->work_time_upper);
							$absence_time = $this->calculateAbsenceTime($start_time, $end_time, $this->absence_time_lower, $this->absence_time_upper);
							$defective_time = $this->defective_time - $work_time;

							if ($defective_time < 0)
								$defective_time = 0;

							$calculations->push(new Calculation([
								'date' => $data[$i]['date']->format('Y-m-d'),
								'work_time' => $work_time,
								'absence_time' => $absence_time,
								'defective_time' => $defective_time,
								'user_id' => $user->id
							]));
						}
					}
				}

				// Add timestamps for each calculation item
				$current_date = now();
				$calculations = array_map(function ($calculation) use ($current_date) {
					$calculation['created_at'] = $current_date;
					$calculation['updated_at'] = $current_date;

					return $calculation;
				}, $calculations->toArray());

				// Insert data to database
				Calculation::insert($calculations);

				$this->info("Attendance data for '{$user->name}' has been processed.");
			}
			// Otherwise
			else
				$this->line("There is no attendance data for '{$user->name}' to process.");
		});
	}

	/**
	 * Get all user's attendances to be processed later.
	 *
	 * @param Collection $attendances The attendances collection object.
	 *
	 * @return array
	 */
	private function getAttendanceData(Collection $attendances)
	{
		$last_attendance = null;
		$retval = [];

		$attendances->each(function ($attendance) use (&$retval, &$last_attendance) {
			// If the user is not absent
			if ($attendance->is_sign_in !== null)
			{
				// If is is sign in, save it
				if ($attendance->is_sign_in)
					$last_attendance = $attendance;
				// Otherwise calculate the work time
				else if ($attendance->date->isSameDay($last_attendance->date))
				{
					$last_attendance->is_processed = true;
					$attendance->is_processed = true;

					$diff = $last_attendance->date->diff($attendance->date);
					$retval[] = [
						'date' => $last_attendance->date,
						'work' => $diff
					];
				}
			}
			// Otherwise the user is absent
			else
			{
				$attendance->is_processed = true;

				$retval[] = [
					'date' => $attendance->date,
					'work' => null
				];
			}
		});

		// Update attendances process state
		$attendances = $attendances->where('is_processed', true);
		Attendance::whereIn('id', $attendances->pluck('id'))->update([
			'is_processed' => true
		]);

		return $retval;
	}

	/**
	 * Calculate the work time in minutes.
	 *
	 * @param DateTime $start_time The start date object.
	 * @param DateTime $end_time The end date object.
	 * @param DateTime $work_time_lower The lower work time bound.
	 * @param DateTime $work_time_upper The upper work time bound.
	 *
	 * @return int
	 */
	private function calculateWorkTime(DateTime $start_time, DateTime $end_time, DateTime $work_time_lower, DateTime $work_time_upper)
	{
		$time = $this->getTimeDifference($start_time, $work_time_lower);

		// If time is more than 0, remove the work time before the lower bound
		if ($time > 0)
			$start_time = $start_time->add(new DateInterval('PT' . $time . 'M'));

		$time = $this->getTimeDifference($end_time, $work_time_upper);

		// If time is less than 0, remove the work time after the upper bound
		if ($time < 0)
			$end_time = $end_time->sub(new DateInterval('PT' . ($time * -1) . 'M'));

		$time = $this->getTimeDifference($start_time, $end_time);

		return $time > 0 ? $time : 0;
	}

	/**
	 * Calculate the absence time in minutes.
	 *
	 * @param DateTime $start_time The start date object.
	 * @param DateTime $end_time The end date object.
	 * @param DateTime $absence_time_lower The lower absence time bound.
	 * @param DateTime $absence_time_upper The upper absence time bound.
	 *
	 * @return int
	 */
	private function calculateAbsenceTime(DateTime $start_time, DateTime $end_time, DateTime $absence_time_lower, DateTime $absence_time_upper)
	{
		$absence_time = 0;
		$time = $this->getTimeDifference($start_time, $absence_time_lower);

		// If time is less than 0, then the user is absent for a certain time
		if ($time < 0)
			$absence_time += ($time * -1);

		$time = $this->getTimeDifference($end_time, $absence_time_upper);

		// If time is more than 0, then the user is absent for a certain time
		if ($time > 0)
			$absence_time += $time;

		return $absence_time;
	}

	/**
	 * Setup the date bounds for absence time and work time.
	 *
	 * @param DateTime $date The date object to set.
	 *
	 * @return void
	 */
	private function setDateBounds(DateTime $date)
	{
		$this->absence_time_lower = new DateTime($date);
		$this->absence_time_lower->setTime(8, 30);

		$this->absence_time_upper = new DateTime($date);
		$this->absence_time_upper->setTime(15, 0);

		$this->work_time_lower = new DateTime($date);
		$this->work_time_lower->setTime(7, 30);

		$this->work_time_upper = new DateTime($date);
		$this->work_time_upper->setTime(16, 0);
	}

	/**
	 * Get the difference between two dates in minutes.
	 *
	 * @param DateTime $first_time The first date object.
	 * @param DateTime $second_time The second date object.
	 *
	 * @return int Returns a positive value if **$first_time** before **$second_time** otherwise returns a negative value.
	 */
	private function getTimeDifference(DateTime $first_time, DateTime $second_time)
	{
		$time = $first_time->diff($second_time);

		return ($time->h * 60 + $time->i) * ($time->invert === 1 ? -1 : 1);
	}
}