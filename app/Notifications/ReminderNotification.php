<?php

namespace App\Notifications;

use App\Reminder;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ReminderNotification extends Notification {
	use Queueable;
	/**
	 * @var Reminder
	 */
	private $reminder;

	/**
	 * Create a new notification instance.
	 *
	 * @param Reminder $reminder
	 */
	public function __construct(Reminder $reminder) {
		$this->reminder = $reminder;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed $notifiable
	 *
	 * @return array
	 */
	public function via($notifiable) {
		return ['mail', 'database'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed $notifiable
	 *
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */

	public function toMail($notifiable) {
		return (new MailMessage)
			->subject($this->reminder->title)
			->line(str_replace("%days%", abs($this->reminder->days), $this->reminder->text));
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param  mixed $notifiable
	 *
	 * @return array
	 */
	public function toArray($notifiable) {
		return [
			"transaction_type" => $this->reminder->transactionType->name
		];
	}
}
