<?php

namespace App\Repositories;

use App\Criteria\OrderByCriteria;
use App\Models\Transaction;
use InfyOm\Generator\Common\BaseRepository;

class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'transaction_type_id',
        'amount',
        'payment_type_id',
        'started_at',
        'registered_at',
        'duration',
        'comments'
    ];

    public function boot() {
	    $this->with(['user', 'transactionType'])->pushCriteria(new OrderByCriteria('id', 'DESC'));
    }

	/**
     * Configure the Model
     **/
    public function model()
    {
        return Transaction::class;
    }
}
