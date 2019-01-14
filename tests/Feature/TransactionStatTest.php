<?php
namespace Tests\Feature;


use App\Models\Transaction;
use App\Models\TransactionType;
use App\Services\TransactionStatService;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class TransactionStatTest extends TestCase
{
    use DatabaseMigrations;
    /** @var User $user */
    private $user;
    private $transactionType;

    /** @var Transaction */
    private $firstTransaction;
    /** @var Transaction */
    private $secondTransaction;
    /** @var Transaction */
    private $thirdTransaction;

    public function setUp() {
        parent::setUp();
        $this->seed('TestDatabaseSeeder');

        $this->user = factory(User::class)->create();
        $this->transactionType = TransactionType::where('name', 'Abonnement mensuel')->first();

        // 20€ this month
        $this->firstTransaction = $this->_createTransaction(20, Carbon::now()->toDateTimeString(), 1);
        // 10€ last month
        $this->secondTransaction = $this->_createTransaction(10, Carbon::now()->subMonths(1)->toDateTimeString(), 1);
        // 120€ 4 months ago
        $this->thirdTransaction = $this->_createTransaction(120, Carbon::now()->subMonths(4)->toDateTimeString(), 6);
    }

    public function testTransactionStats() {
        /** @var TransactionStatService $statService */
        $statService = $this->app[TransactionStatService::class];
        // 40€ for current month
        $amount = $statService->getStatsForMonth(Carbon::now());
        $this->assertEquals(20+20, $amount);
        // 30€ for last month
        $amount = $statService->getStatsForMonth(Carbon::now()->subMonths(1));
        $this->assertEquals(10+20, $amount);
        // 20€ for 4 months ago
        $amount = $statService->getStatsForMonth(Carbon::now()->subMonths(4));
        $this->assertEquals(20, $amount);
        // 20€ for next month
        $amount = $statService->getStatsForMonth(Carbon::now()->addMonths(1));
        $this->assertEquals(20, $amount);

        // Update big transaction
        $this->thirdTransaction->amount = 60;
        $this->thirdTransaction->save();

        // Delete this month's transaction
        try {
            $this->firstTransaction->delete();
        } catch (\Exception $e) {
        }

        // 10€ for current month
        $amount = $statService->getStatsForMonth(Carbon::now());
        $this->assertEquals(10, $amount);
        // 20€ for last month
        $amount = $statService->getStatsForMonth(Carbon::now()->subMonths(1));
        $this->assertEquals(10+10, $amount);
        // 10€ for 4 months ago
        $amount = $statService->getStatsForMonth(Carbon::now()->subMonths(4));
        $this->assertEquals(10, $amount);
        // 10€ for next month
        $amount = $statService->getStatsForMonth(Carbon::now()->addMonths(1));
        $this->assertEquals(10, $amount);

        // Adding a yearly shouldn't influence results
        factory(Transaction::class)->make([
            'amount' => 5,
            'duration' => 12,
            'started_at' => Carbon::now()->subMonths(8)->toDateTimeString(),
            'transaction_type_id' => function() {
                return TransactionType::where('name', 'Cotisation annuelle')->first()->id;
            },
        ]);
        // 0€ for 7 months ago
        $amount = $statService->getStatsForMonth(Carbon::now()->subMonths(7));
        $this->assertEquals(0, $amount);
    }

    /**
     * @param $amount
     * @param $started_at
     * @param $duration
     * @return Transaction
     */
    private function _createTransaction($amount, $started_at, $duration) {
        $transaction = factory(Transaction::class)->make([
            'started_at' => $started_at,
            'amount' => $amount,
            'duration' => $duration
        ]);
        $transaction->user()->associate($this->user);
        $transaction->save();
        return $transaction;
    }
}
