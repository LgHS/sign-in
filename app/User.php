<?php

namespace App;

use App\Models\Transaction;
use App\Models\TransactionType;
use App\Notifications\InitPasswordNotification;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable {
	use FormAccessible;
	use Notifiable;
	use HasApiTokens;

	use SoftDeletes, EntrustUserTrait {
		SoftDeletes::restore insteadof EntrustUserTrait;
		EntrustUserTrait::restore insteadof SoftDeletes;
	}

	protected $dates = ['deleted_at'];

	protected $fillable = [
		'date_of_birth',
		'lastName',
		'firstName',
		'gender',
		'address',
		'postcode',
		'city',
		'country',
		'phone',
		'member_since',
		'is_public',
		'is_active',
		'transactions',
	];

	protected $hidden = [
		'id',
		'username',
		'email',
		'password',
        'pin',
		'remember_token',
		'token_valid',
		'totp',
		'uuid'
	];

	public static $rules = [
	    'pin' => 'required|digits:4'
    ];

	public function getFullNameAttribute() {
		return ucfirst($this->firstName) . ' ' . ucfirst($this->lastName);
	}

	public function getIsLateAttribute() {
		$isLate = false;
		foreach($this->dueDates as $dueDate) {
			if($dueDate['difference'] < 0) {
				$isLate = true;
			}
		}

		return $isLate;
	}

	/*public function getDueDatesAttribute() {
		$due_dates = [];
		foreach($this->transactions as $transaction) {
			$due_date = array(
				'name' => $transaction->transactionType->name,
				'date' => $transaction->started_at->addMonths($transaction->duration),
				'difference' => Carbon::today()->diffInDays($transaction->started_at->addMonths($transaction->duration), false)
			);


			// if there's no due date set for this type of transaction
			if( ! isset($due_dates[ $transaction->transactionType->id ])) {
				$due_dates[ $transaction->transactionType->id ] = $due_date;
			} else {
				$old_due_date = $due_dates[ $transaction->transactionType->id ]['date'];
				// we check if transaction is more recent then previously registered
				if($old_due_date->lt($due_date['date'])) {
					$due_dates[ $transaction->transactionType->id ] = $due_date;
				}
			}
		};

		return $due_dates;
	}*/

	public function getLastTransaction(TransactionType $transactionType) {
		if( ! $this->has('transactions')) {
			return null;
		}

		return $this->transactions()
		            ->where('transaction_type_id', $transactionType->id)
		            ->orderBy('started_at', 'desc')
		            ->first();
	}

	public function getRemainingDays(TransactionType $transactionType) {
		$lastTransaction = $this->getLastTransaction($transactionType);

		if(!$lastTransaction) {
			return null;
		}

		return Carbon::today()->diffInDays($lastTransaction->endDate, false);
	}

	public function isLate(TransactionType $transactionType) {
		return $this->getRemainingDays($transactionType) < 0;
	}

	public function transactions() {
		return $this->hasMany(Transaction::class);
	}

	public function rfidCards() {
		return $this->hasMany(RfidCard::class);
	}

	public function formDateOfBirthAttribute($value) {
		if( ! $value) {
			return '';
		}

		return Carbon::parse($value)->format('d/m/Y');
	}

	public function formMemberSinceAttribute($value) {
		if( ! $value) {
			return '';
		}

		return Carbon::parse($value)->format('d/m/Y');
	}

	public function sendPasswordResetNotification($token) {
		$this->notify(new ResetPasswordNotification($token));
	}

	// https://github.com/Zizaco/entrust/issues/480

	public function sendPasswordInitNotification($token) {
		$this->notify(new InitPasswordNotification($token));
	}

	public function restore() {
		$this->sfRestore();
		Cache::tags(Config::get('entrust.role_user_table'))->flush();
	}
}
