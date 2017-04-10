<?php

namespace App;

use App\Models\Transaction;
use App\Notifications\InitPasswordNotification;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
		'is_active'
	];

	protected $hidden = [
		'id',
		'username',
		'email',
		'password',
		'remember_token',
		'token_valid',
		'totp',
		'uuid'
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

	public function getDueDatesAttribute() {
		$due_dates = [];
		/** @var Transaction $transaction */
		//var_dump($this->transactions); exit;
		foreach($this->transactions as $transaction) {
			$due_date = array(
				'name' => $transaction->transactionType->name,
				'date' => $transaction->started_at->addMonths($transaction->duration),
				'difference' => Carbon::today()->diffInDays($transaction->started_at->addMonths($transaction->duration), false)
			);


			// if there's no due date set for this type of transaction
			if( ! isset($due_dates[ $transaction->transactionType->id ])) {
				$due_dates[$transaction->transactionType->id] = $due_date;
			} else {
				$old_due_date = $due_dates[ $transaction->transactionType->id ]['date'];
				// we check if transaction is more recent then previously registered
				if($old_due_date->lt($due_date['date'])) {
					$due_dates[$transaction->transactionType->id] = $due_date;
				}
			}
		};

		return $due_dates;
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

	public function sendPasswordInitNotification($token) {
		$this->notify(new InitPasswordNotification($token));
	}

	// https://github.com/Zizaco/entrust/issues/480
	public function restore() {
		$this->sfRestore();
		Cache::tags(Config::get('entrust.role_user_table'))->flush();
	}

	public function transactions() {
		return $this->hasMany(Transaction::class);
	}
}
