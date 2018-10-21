<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Models\PaymentType;
use App\Models\Transaction;
use App\Models\TransactionType;
use Carbon\Carbon;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'uuid' => Uuid::generate(),
        'username' => $faker->userName,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Transaction::class, function(Faker\Generator $faker) {
	return [
		'payment_type_id' => function() {
			return PaymentType::find(1)->first()->id;
		},
		'transaction_type_id' => function() {
			// monthly
			return TransactionType::where('name', 'Abonnement mensuel')->first()->id;
		},
		'registered_at' => Carbon::now()->toDateTimeString(),
		'amount' => 20,
		'duration' => 1,
	];
});

$factory->state(Transaction::class, 'annual', function() {
	return [
		'amount' => 5,
		'duration' => 12,
		'transaction_type_id' => function() {
			// annual
			return TransactionType::where('name', 'Cotisation annuelle')->first()->id;
		}
	];
});
