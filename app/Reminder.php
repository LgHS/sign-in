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
		'text'
	];

	protected $casts = [
		'transaction_type_id' => 'integer'
	];

	public function transactionType() {
		return $this->belongsTo(\App\Models\TransactionType::class, 'transaction_type_id', 'id');
	}

	public function shouldSendTo(User $user, $dump = false) {
		$lastTransaction = $user->getLastTransaction($this->transactionType);
		if($dump) {
			echo "transaction start: "; var_dump($lastTransaction->started_at);
			echo "transaction end: "; var_dump($lastTransaction->endDate);
			echo "days: "; var_dump($this->days);
			echo "is today: "; var_dump($lastTransaction->endDate->addDays($this->days));
		}
		return $lastTransaction->endDate->addDays($this->days)->isToday();
	}

	public function daysUntilEnd(User $user) {
		return 0;
	}
}
