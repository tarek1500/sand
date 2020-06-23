<?php

namespace App\Console\Commands;

use App\Attendance;
use App\User;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class CheckAttendance extends Command
{
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
		User::all()->each(function ($user) {
			// Get all user's attendances where they are not processed yet
			$attendances = $user->attendance()->where('is_processed', false)->get();

			// If the user has unprocessed attendance
			if ($attendances->count() > 0)
			{
				$last_attendance = null;
				$data = new Collection;

				// Get all user's attendances and add to array to be processed later
				$attendances->each(function ($attendance) use ($data, &$last_attendance) {
					// If the user is not absent
					if ($attendance->is_sign_in !== null)
					{
						// If is is sign in, save it
						if ($attendance->is_sign_in)
							$last_attendance = $attendance;
						// Otherwise calculate the work time
						else
						{
							$diff = $attendance->date->diff($last_attendance->date);
							$data->push([
								'date' => $attendance->date,
								'work' => $diff
							]);
						}
					}
					// Otherwise the user is absent
					else
					{
						$data->push([
							'date' => $attendance->date,
							'work' => null
						]);
					}
				});

				// Update attendances process state
				Attendance::whereIn('id', $attendances->pluck('id'))->update([
					'is_processed' => true
				]);

				$this->info("User name: {$user->name}:");
				$count = $data->count();

				// Loop through collected data
				for ($i = 1; $i <= $count; $i++)
				{
					// Make sure the index doesn't go beyond the limit, and check if the previous attendance is the same as the current
					if ($i < $count && $data[$i]['date']->isSameDay($data[$i - 1]['date']))
					{
						// Add both work times to new date
						$temp_date = new DateTime();
						$temp_date->add($data[$i - 1]['work']);
						$temp_date->add($data[$i]['work']);

						// Remove the old two date, and add new one
						$data->splice($i - 1, 2, [[
							'date' => $data[$i - 1]['date'],
							'work' => $temp_date->diff(new DateTime())
						]]);

						$count--;
						$i--;
					}
					// If the user is absent, print absence message
					else if ($data[$i - 1]['work'] === null)
						$this->info("Date: {$data[$i - 1]['date']->toDateString()}, Absence");
					// If the user is working more than 7.5 hours, print work details
					else if ($data[$i - 1]['work']->h >= 7 && $data[$i - 1]['work']->i >= 30)
						$this->info("Date: {$data[$i - 1]['date']->toDateString()}, Work time: {$data[$i - 1]['work']->format("%H hours : %I minutes")}");
					// Otherwise, print work details with defective
					else
						$this->info("Date: {$data[$i - 1]['date']->toDateString()}, Work time: {$data[$i - 1]['work']->format("%H hours : %I minutes")} (defective)");
				}

				$this->info('');
			}
			// Otherwise
			else
				$this->info("There is no data for '{$user->name}' to process.");
		});
	}
}