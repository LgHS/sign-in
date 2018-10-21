<?php

namespace App\Models;

use App\Events\TransactionCreated;
use App\Services\TransactionStatService;
use Carbon\Carbon;
use Eloquent as Model;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

/**
 * Class Transaction
 * @package App\Models
 * @version February 18, 2017, 11:03 am UTC
 */
class Transaction extends Model
{
    use SoftDeletes;
    use Notifiable;

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

//    protected $events = [
//        'created' => TransactionCreated::class,
//    ];
//
//    protected $dispatchesEvents = [
//        'created' => TransactionCreated::class,
//    ];

    /**
	 * @return Carbon Transaction end date
	 */
    public function getEndDateAttribute() {
    	return $this->started_at->addMonths($this->duration);
    }

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

    /*public function formStartedAtAttribute($value) {
	    if( ! $value) {
		    return '';
	    }

	    return Carbon::parse($value)->format('d/m/Y');
    }*/
}
