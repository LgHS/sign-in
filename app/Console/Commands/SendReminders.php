<?php

namespace App\Console\Commands;

use App\Notifications\ReminderNotification;
use App\Reminder;
use App\User;
use Illuminate\Console\Command;

class SendReminders extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'reminders:send';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Send reminders to members';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 */
	public function handle() {
		$counter = 0;
		foreach(User::all() as $user) {
			foreach(Reminder::all() as $reminder) {
				if($user->has('transactions')) {
					if($reminder->shouldSendTo($user)) {
						$user->notify(new ReminderNotification($reminder->text, $reminder->days));
						$counter ++;
					}
				}
			}
		}

		if($counter) {
			$this->info($counter . " reminders sent");
		} else {
			$this->info("No reminder to send");
		}
	}
}
