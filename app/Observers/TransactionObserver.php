<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 21/10/2018
 * Time: 23:51
 */

namespace App\Observers;


use App\Models\Transaction;
use App\Services\TransactionStatService;

class TransactionObserver {
    public function created(Transaction $transaction) {
        app(TransactionStatService::class)->addTransaction($transaction);
    }

    public function updated(Transaction $transaction) {
        app(TransactionStatService::class)->updateTransaction($transaction);
    }

    public function deleted(Transaction $transaction) {
        app(TransactionStatService::class)->deleteTransaction($transaction);
    }
}
