<?php

use App\Models\TransactionType;
use App\Reminder;
use Illuminate\Database\Seeder;

class RemindersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		/**
		 * abo mensuel
			 * auto: dernier jour
			 * auto: 7 jours après fin coti
		    * manuel: "en retard"
		 * coti annuelle
			 * auto: 7 jours avant
			 * auto: dernier jour
			 * auto: 7 jours après
			 * auto: 30 jours (fermeture des services)
		 */
		$annual = TransactionType::where('name', 'Cotisation annuelle')->first();
		$monthly = TransactionType::where('name', 'Abonnement mensuel')->first();

		// Monthly last day
		$reminder        = new Reminder();
		$reminder->title = "Dernier jour de ton abonnement mensuel";
		$reminder->name  = "Monthly last day";
		$reminder->text  = "Ton abonnement arrive à échéance aujourd'hui. N'oublie pas de renouveller la prochaine fois que tu viens !";
		$reminder->days  = 0;
		$reminder->transactionType()->associate($monthly);
		$reminder->save();

		// Monthly late
		$reminder = new Reminder();
		$reminder->title = "Rappel: abonnement expiré";
		$reminder->name = "Monthly late";
		$reminder->text = "Ton abonnement est expiré depuis %days% jours. N'oublie pas de renouveller !";
		$reminder->days = 7;
		$reminder->transactionType()->associate($monthly);
		$reminder->save();

		// Annual before
		$reminder        = new Reminder();
		$reminder->title = "Expiration de ta cotisation annuelle";
		$reminder->name  = "Annual before";
		$reminder->text  = "Ta cotisation annuelle expire dans %days% jours. N'oublie pas de renouveller !";
		$reminder->days  = -7;
		$reminder->transactionType()->associate($annual);
		$reminder->save();

		// Annual last day
		$reminder        = new Reminder();
		$reminder->title = "Dernier jour de ta cotisation annuelle";
		$reminder->name  = "Annual last day";
		$reminder->text  = "Ta cotisation annuelle arrive à échéance aujourd'hui. N'oublie pas de renouveller !";
		$reminder->days  = 0;
		$reminder->transactionType()->associate($annual);
		$reminder->save();

		// Annual 7 days late
		$reminder        = new Reminder();
		$reminder->title = "Rappel: cotisation annuelle";
		$reminder->name  = "Annual after";
		$reminder->text  = "Ta cotisation annuelle est expirée depuis %days% jours. N'oublie pas de renouveller !";
		$reminder->days  = 7;
		$reminder->transactionType()->associate($annual);
		$reminder->save();

		// Annual 30 days late
		$reminder        = new Reminder();
		$reminder->title = "Rappel: cotisation annuelle";
		$reminder->name  = "Annual after 30";
		$reminder->text  = "Ta cotisation annuelle est expirée depuis %days% jours. Si tu ne souhaites pas renouveller, ton affiliation sera automatiquement résiliée dans un mois.";
		$reminder->days  = 30;
		$reminder->transactionType()->associate($annual);
		$reminder->save();

		// Annual cancelling
		$reminder        = new Reminder();
		$reminder->title = "Résiliation de ton affiliation";
		$reminder->name  = "Annual cancelling";
		$reminder->text  = "Cela fait deux mois que ta cotisation annuelle est expirée, tu es maintenant considéré comme un ancien membre et n'a plus accès à nos différents services. Si c'est une erreur, contacte-nous. Sinon so long, reste en contact !";
		$reminder->days  = 60;
		$reminder->transactionType()->associate($annual);
		$reminder->save();
	}
}
