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
	}

	public function testFirstTransactionIsNotLast() {
		$this->assertFalse($this->firstTransaction->is($this->user->getLastTransaction($this->transactionType)));
	}

	public function testSecondTransactionIsLast() {
		$this->assertTrue($this->secondTransaction->is($this->user->getLastTransaction($this->transactionType)));
	}
}
