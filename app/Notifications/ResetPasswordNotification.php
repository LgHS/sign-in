<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword {
	public function via($notifiable) {
		return ['mail', 'database'];
	}

	public function toMail($notifiable) {
		return (new MailMessage)
			->subject('Demande de réinitialisation du mot de passe')
			->greeting('Bonjour !')
			->line('Tu reçois cet e-mail car tu as demandé un lien de réinitialisation de ton mot de passe.')
			->action('Réinitialiser le mot de passe', url('password/reset', $this->token))
			->line('Si tu n\'as pas demandé un lien de réinitialisation, tu n\'as rien à faire. Sit back and relax.');
	}

	public function toArray($notifiable) {
		return [];
	}
}