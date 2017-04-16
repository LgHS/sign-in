<?php

namespace tests\Feature;

use App\Models\PaymentType;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TransactionsTest extends TestCase {
	use DatabaseMigrations;

	/** @var User $user */
	private $user;
	private $transactionType;
	private $firstTransaction;
	private $secondTransaction;
	private $annualTransaction;

	public function setUp() {
		parent::setUp();

		$this->seed('TestDatabaseSeeder');

		$this->user = factory(User::class)->create();
		$this->transactionType = TransactionType::where('name', 'Abonnement mensuel')->first();

		$this->firstTransaction = factory(Transaction::class)->make([
			'started_at' => Carbon::now()->subWeeks(3)->toDateTimeString()
		]);
		$this->firstTransaction->user()->associate($this->user);
		$this->firstTransaction->save();

		$this->secondTransaction = factory(Transaction::class)->make([
			'started_at' => Carbon::now()->subWeeks(1)->toDateTimeString()
		]);
		$this->secondTransaction->user()->associate($this->user);
		$this->secondTransaction->save();


		$this->annualTransaction = factory(Transaction::class)->states('annual')->make([
			'started_at' => Carbon::now()->subMonths(8)->toDateTimeString()
		]);
		$this->annualTransaction->user()->associate($this->user);
		$this->annualTransaction->save();
	}

	public function testFirstTransactionIsNotLast() {
		$this->assertFalse($this->firstTransaction->is($this->user->getLastTransaction($this->transactionType)));
	}

	public function testSecondTransactionIsLast() {
		$this->assertTrue($this->secondTransaction->is($this->user->getLastTransaction($this->transactionType)));
	}

	public function testAnnualTransactionIsLast() {
		$annualTransactionType = TransactionType::where('name', 'Cotisation annuelle')->first();
		/** @var Transaction $annualLastTransaction */
		$annualLastTransaction = $this->user->getLastTransaction($annualTransactionType);
		//echo "\n\ntransaction: "; var_dump($annualLastTransaction);
		echo "\n\nannual id: " . $this->annualTransaction->id;
		echo "\nlast annual id: " . $annualLastTransaction->id;
		echo "\nlast annual type: " . $annualLastTransaction->transactionType->name;
		$this->assertTrue($this->annualTransaction->is($annualLastTransaction));
	}
}
