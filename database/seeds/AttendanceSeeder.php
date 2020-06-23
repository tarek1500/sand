<?php

use App\User;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		if ($user = User::find(1))
		{
			$user->attendance()->createMany([
				['date' => new DateTime('01-01-2020 08:28:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('01-01-2020 16:12:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('02-01-2020 09:13:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('02-01-2020 16:25:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('05-01-2020 11:01:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('05-01-2020 15:45:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('06-01-2020 07:53:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('06-01-2020 15:41:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('07-01-2020 07:47:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('07-01-2020 13:05:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('08-01-2020 08:08:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('08-01-2020 15:50:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('09-01-2020 07:56:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('09-01-2020 15:04:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('12-01-2020 08:06:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('12-01-2020 16:00:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('13-01-2020 07:51:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('13-01-2020 11:38:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('14-01-2020 07:57:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('14-01-2020 15:38:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('15-01-2020 09:29:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('15-01-2020 16:09:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('16-01-2020 09:30:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('16-01-2020 15:05:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('19-01-2020 08:09:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('19-01-2020 10:47:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('19-01-2020 13:12:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('19-01-2020 15:59:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('19-01-2020'), 'is_processed' => false]
			]);
		}

		if ($user = User::find(2))
		{
			$user->attendance()->createMany([
				['date' => new DateTime('01-01-2020 08:15:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('01-01-2020 15:46:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('02-01-2020 08:20:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('02-01-2020 15:46:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('05-01-2020 08:29:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('05-01-2020 15:51:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('06-01-2020 08:25:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('06-01-2020 16:12:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('07-01-2020 08:15:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('07-01-2020 15:48:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('08-01-2020 08:28:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('08-01-2020 15:45:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('09-01-2020 08:21:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('09-01-2020 16:00:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('12-01-2020 08:20:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('12-01-2020 15:57:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('13-01-2020 08:23:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('13-01-2020 16:05:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('14-01-2020 08:15:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('14-01-2020 15:41:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('15-01-2020'), 'is_processed' => false],
				['date' => new DateTime('16-01-2020'), 'is_processed' => false],
				['date' => new DateTime('19-01-2020 08:21:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('19-01-2020 13:33:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('19-01-2020 14:32:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('19-01-2020 16:05:00'), 'is_sign_in' => false, 'is_processed' => false]
			]);
		}

		if ($user = User::find(3))
		{
			$user->attendance()->createMany([
				['date' => new DateTime('01-01-2020 08:29:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('01-01-2020 15:54:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('02-01-2020 08:32:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('02-01-2020 12:22:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('05-01-2020'), 'is_processed' => false],
				['date' => new DateTime('06-01-2020 08:38:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('06-01-2020 16:14:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('07-01-2020 08:25:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('07-01-2020 15:35:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('08-01-2020 08:34:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('08-01-2020 16:10:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('09-01-2020 08:36:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('09-01-2020 16:11:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('12-01-2020 08:37:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('12-01-2020 16:09:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('13-01-2020 08:18:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('13-01-2020 16:04:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('14-01-2020 08:27:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('14-01-2020 16:04:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('15-01-2020 08:42:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('15-01-2020 16:08:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('16-01-2020 08:23:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('16-01-2020 16:01:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('19-01-2020 08:34:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('19-01-2020 16:15:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('20-01-2020 08:23:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('20-01-2020 16:11:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('21-01-2020 08:34:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('21-01-2020 16:08:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('22-01-2020 07:26:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('22-01-2020 15:00:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('23-01-2020 06:57:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('23-01-2020 15:00:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('26-01-2020 07:05:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('26-01-2020 15:02:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('27-01-2020 07:07:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('27-01-2020 15:00:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('28-01-2020 07:01:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('28-01-2020 15:05:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('29-01-2020 08:10:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('29-01-2020 10:53:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('29-01-2020 13:11:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('29-01-2020 16:20:00'), 'is_sign_in' => false, 'is_processed' => false]
			]);
		}

		if ($user = User::find(4))
		{
			$user->attendance()->createMany([
				['date' => new DateTime('01-01-2020 08:39:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('01-01-2020 15:00:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('02-01-2020 08:20:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('02-01-2020 13:45:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('05-01-2020 08:38:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('05-01-2020 16:01:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('06-01-2020 08:28:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('06-01-2020 15:44:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('07-01-2020 08:36:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('07-01-2020 16:29:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('08-01-2020 08:04:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('08-01-2020 18:06:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('09-01-2020 08:36:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('09-01-2020 13:02:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('12-01-2020 08:05:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('12-01-2020 15:34:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('13-01-2020 09:12:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('13-01-2020 15:20:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('14-01-2020 08:26:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('14-01-2020 15:00:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('15-01-2020 08:29:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('15-01-2020 11:35:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('16-01-2020 08:37:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('16-01-2020 15:02:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('19-01-2020 08:30:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('19-01-2020 15:12:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('20-01-2020 07:07:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('20-01-2020 15:00:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('21-01-2020 07:28:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('21-01-2020 15:00:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('22-01-2020 07:26:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('22-01-2020 15:00:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('23-01-2020 07:14:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('23-01-2020 15:04:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('26-01-2020 08:30:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('26-01-2020 09:52:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('26-01-2020 12:37:00'), 'is_sign_in' => true, 'is_processed' => false],
				['date' => new DateTime('26-01-2020 17:05:00'), 'is_sign_in' => false, 'is_processed' => false],
				['date' => new DateTime('27-01-2020'), 'is_processed' => false]
			]);
		}
	}
}