<?php

namespace App\Services;


use App\Models\Transaction;
use App\Models\TransactionStat;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionStatService
{
    public function __construct(\App $app) {
        $bite = "lol"; // <~~~~ iooner
    }

    public function generateAllStats() {
        DB::table('transaction_stats')->truncate();
        $transactions = Transaction::all();
        foreach ($transactions as $transaction) {
            $this->addTransaction($transaction);
        }
    }

    public function addTransaction(Transaction $transaction) {
        $this->_updateStats($transaction, "add");
    }

    public function updateTransaction() {
        // FIXME With this method, we're fucked if we update a transaction :
        // we can't tell if the amount has changed or the duration
        // so how can we update month row ?
        // Maybe we can get transaction data before update and do
        // complicated stuff to update stats.
        // Or we can change the whole pattern for stats and generate it
        // when needed. We could cache it in a DB and use a "dirty" flag
        // to fire the generation.

        // For now the quick fix is to regenerate everything :
        $this->generateAllStats();
    }

    public function deleteTransaction(Transaction $transaction) {
        $this->_updateStats($transaction, "subtract");
    }

    public function getStatsForMonth($month) {
        $monthRow = TransactionStat
            ::whereMonth('month', '=', $month->month)
            ->whereYear('month', '=', $month->year)
            ->first();


        if ($monthRow) {
            return $monthRow->amount;
        } else {
            return null;
        }
    }


    private function _updateStats(Transaction $transaction, $method) {
        // we only count monthly subscriptions
        if($transaction->transactionType->name != "Abonnement mensuel") {
            return;
        }

        // iterate on all months from duration
        for ($i = 0; $i < $transaction->duration; $i++) {
            $currentDate = Carbon::parse($transaction->started_at)->addMonth($i);
            $currentAmount = $transaction->amount / $transaction->duration;

            /** @var TransactionStat $monthRow */
            $monthRow = TransactionStat
                ::whereMonth('month', '=', $currentDate->month)
                ->whereYear('month', '=', $currentDate->year)
                ->first();

            if($method == "subtract") {
                $monthRow->amount -= $currentAmount;
                $monthRow->save();
            } else if ($method == "add") {
                if (!$monthRow) {
                    // If month doesn't exist in DB, create it and add amount
                    $transactionStatRow = new TransactionStat();
                    $transactionStatRow->month = $currentDate->toDateTimeString();
                    $transactionStatRow->amount = $currentAmount;
                    $transactionStatRow->save();
                } else {
                    // If month exists, increment amount
                    $monthRow->amount += $currentAmount;
                    $monthRow->save();
                }
            }
        }
    }
}
