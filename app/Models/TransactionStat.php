<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionStat extends Model {
    public $table = 'transaction_stats';

    protected $dates = ['started_at', 'month', 'deleted_at'];

    public $fillable = ['month', 'amount'];
}
