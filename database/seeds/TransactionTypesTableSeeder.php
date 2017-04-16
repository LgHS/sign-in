<?php

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$annual = new TransactionType();
		$annual->name = 'Cotisation annuelle';
		$annual->has_duration = true;
		$annual->default_duration = 12;
		$annual->default_amout = 5;
		$annual->save();

		$monthly = new TransactionType();
		$monthly->name = 'Abonnement mensuel';
		$monthly->has_duration = true;
		$monthly->default_duration = 1;
		$monthly->default_amout = 20;
		$monthly->save();
	}
}