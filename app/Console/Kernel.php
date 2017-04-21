<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel {
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		// Commands\Inspire::class,
		Commands\SendReminders::class,
		Commands\ImportMemberships::class,
		Commands\AddMembership::class,
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule $schedule
	 *
	 * @return void
	 */
	protected function schedule(Schedule $schedule) {
		$schedule->command('reminders:send')
		         ->timezone('Europe/Brussels')
		         ->dailyAt('12:00')
		         ->appendOutputTo('./storage/logs/scheduler.log');

		$schedule->command('backup:clean')
				->timezone('Europe/Brussels')
				->dailyAt('01:00')
				->appendOutputTo('./storage/logs/scheduler.log');

		$schedule->command('backup:run')
				->timezone('Europe/Brussels')
				->dailyAt('02:00')
				->appendOutputTo('./storage/logs/scheduler.log');
	}
}