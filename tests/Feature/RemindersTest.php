<?php

namespace tests\Feature;

use App\Models\PaymentType;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Reminder;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RemindersTest extends TestCase {
	use DatabaseMigrations;

	public function setUp() {
		parent::setUp();
		$this->seed('TestDatabaseSeeder');
	}

	/**
	 * Test that there's no reminder to send
	 */
	public function testNoReminder() {
		$user = factory(User::class)->create();

		$annual = factory(Transaction::class)->states('annual')->make([
			'started_at' => Carbon::now()->subMonths(3)->toDateTimeString()
		]);
		$annual->user()->associate($user);
		$annual->save();

		$monthly = factory(Transaction::class)->make([
			'started_at' => Carbon::now()->subWeeks(2)->toDateTimeString()
		]);
		$monthly->user()->associate($user);
		$monthly->save();

		$sendReminder = false;

		/** @var Reminder $reminder */
		foreach(Reminder::all() as $reminder) {
			if($reminder->shouldSendTo($user)) {
				$sendReminder = true;
			}
		}

		$this->assertFalse($sendReminder);
	}

	/**
	 * Monthly last day
	 */
	public function testMonthlyLastDay() {
		$user = factory(User::class)->create();
		$monthly = factory(Transaction::class)->make([
			'started_at' => Carbon::now()->subMonth()->toDateTimeString()
		]);
		$monthly->user()->associate($user);
		$monthly->save();

		$this->assertTrue(Reminder::where('name', 'Monthly last day')->first()->shouldSendTo($user));
		$this->assertFalse(Reminder::where('name', 'Annual last day')->first()->shouldSendTo($user));
	}

	/**
	 * Monthly late
	 */
	/*public function testMonthlyLate() {
		$user = factory(User::class)->create();
		$monthly = factory(Transaction::class)->make([
			'started_at' => Carbon::now()->subMonth()->subDays(7)->toDateTimeString()
		]);
		$monthly->user()->associate($user);
		$monthly->save();

		$this->assertTrue(Reminder::where('name', '=', 'Monthly late')->first()->shouldSendTo($user));
	}*/

	/**
	 * Annual before
	 */
	public function testAnnualBefore() {
		$user = factory(User::class)->create();
		$annual = factory(Transaction::class)->states('annual')->make([
			'started_at' => Carbon::now()->subYear()->addDays(7)->toDateTimeString()
		]);
		$annual->user()->associate($user);
		$annual->save();

		$this->assertTrue(Reminder::where('name', 'Annual before')->first()->shouldSendTo($user));
	}

	/**
	 * Annual last day for annual
	 */
	public function testAnnualLastDay() {
		$user = factory(User::class)->create();
		$annual = factory(Transaction::class)->states('annual')->make([
			'started_at' => Carbon::now()->subYear()->toDateTimeString()
		]);
		$annual->user()->associate($user);
		$annual->save();

		$this->assertTrue(Reminder::where('name', 'Annual last day')->first()->shouldSendTo($user));
	}

	/**
	 * Annual after
	 */
	public function testAnnualAfter() {
		$user = factory(User::class)->create();
		$annual = factory(Transaction::class)->states('annual')->make([
			'started_at' => Carbon::now()->subYear()->subDays(7)->toDateTimeString()
		]);
		$annual->user()->associate($user);
		$annual->save();

		$this->assertTrue(Reminder::where('name', 'Annual after')->first()->shouldSendTo($user));
	}

	/**
	 * Annual cancelling
	 */
	public function testAnnualCancelling() {
		$user = factory(User::class)->create();
		$annual = factory(Transaction::class)->states('annual')->make([
			'started_at' => Carbon::now()->subYear()->subDays(30)->toDateTimeString()
		]);
		$annual->user()->associate($user);
		$annual->save();


		$this->assertTrue(Reminder::where('name', 'Annual cancelling')->first()->shouldSendTo($user));
	}
}
