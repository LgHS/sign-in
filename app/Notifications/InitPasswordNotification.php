<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class InitPasswordNotification extends ResetPassword {
	public function toMail($notifiable) {
		return (new MailMessage)
//			->view('emails.welcome', array(
//				'nice_url' => explode('//', config('app.url'))[1],
//				'token' => $this->token
//			));
			->subject('Bienvenue sur ' . explode('//', config('app.url'))[1])
			->greeting('Bienvenue !')
			->line('Nous t\'avons créé un compte qui te permettra de te connecter à nos différents services ' .
			       '(Rocket.Chat, Wiki, Loomio).')
			->line('Tu trouveras plus d\'informations sur le wiki : wiki.lghs.be/membres')
			->line('Pour compléter ton inscription, clique sur le lien ci-dessous afin de choisir un mot de passe ' .
			       '(Attention ce lien expire dans 24 heures):')
			->action('Choisir un mot de passe', url('password/init', $this->token));
	}
}