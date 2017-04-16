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
		$reminder = new Reminder();
		$reminder->name = "Monthly last day";
		$reminder->text = "<b>Last day for monthly</b>";
		$reminder->days = 0;
		$reminder->transactionType()->associate($monthly);
		$reminder->save();

		// Monthly late
		$reminder = new Reminder();
		$reminder->name = "Monthly late";
		$reminder->text = "Late since %days% days";
		$reminder->days = 7;
		$reminder->transactionType()->associate($monthly);
		$reminder->save();

		// Annual before
		$reminder = new Reminder();
		$reminder->name = "Annual before";
		$reminder->text = "Only 7 days";
		$reminder->days = -7;
		$reminder->transactionType()->associate($annual);
		$reminder->save();

		// Annual last day
		$reminder = new Reminder();
		$reminder->name = "Annual last day";
		$reminder->text = "Last day for annual";
		$reminder->days = 0;
		$reminder->transactionType()->associate($annual);
		$reminder->save();

		// Annual 7 days late
		$reminder = new Reminder();
		$reminder->name = "Annual after";
		$reminder->text = "Late since %days% days";
		$reminder->days = 7;
		$reminder->transactionType()->associate($annual);
		$reminder->save();

		// Annual cancelling
		$reminder = new Reminder();
		$reminder->name = "Annual cancelling";
		$reminder->text = "30 days, cancelling annual";
		$reminder->days = 30;
		$reminder->transactionType()->associate($annual);
		$reminder->save();
	}
}
