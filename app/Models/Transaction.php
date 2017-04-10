<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction
 * @package App\Models
 * @version February 18, 2017, 11:03 am UTC
 */
class Transaction extends Model
{
    use SoftDeletes;

    public $table = 'transactions';
    

    protected $dates = ['started_at', 'registered_at', 'deleted_at'];


    public $fillable = [
        'user_id',
        'transaction_type_id',
        'amount',
        'payment_type_id',
        'started_at',
        'registered_at',
        'duration',
        'comments'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'transaction_type_id' => 'integer',
        'amount' => 'float',
        'payment_type_id' => 'integer',
        'duration' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'transaction_type_id' => 'required',
        'amount' => 'required',
        'payment_type_id' => 'required',
        'started_at' => 'required',
        'registered_at' => 'required',
        'duration' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function transactionType()
    {
        return $this->belongsTo(\App\Models\TransactionType::class, 'transaction_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function paymentType()
    {
        return $this->belongsTo(\App\Models\PaymentType::class, 'payment_type_id', 'id');
    }
}
