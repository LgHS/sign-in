<?php

namespace App;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
	public $table = 'reminders';

	public $fillable = [
		'transaction_type_id',
		'name',
		'title',
		'days',
		'text'
	];

	protected $casts = [
		'transaction_type_id' => 'integer'
	];

	public function transactionType() {
		return $this->belongsTo(\App\Models\TransactionType::class, 'transaction_type_id', 'id');
	}

	public function shouldSendTo(User $user) {
		$lastTransaction = $user->getLastTransaction($this->transactionType);
		if(!$lastTransaction) {
			return false;
		}

		return $lastTransaction->endDate->addDays($this->days)->isToday();
	}

	public function daysUntilEnd(User $user) {
		return 0;
	}
}