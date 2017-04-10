<?php

namespace App\Repositories;

use App\Models\TransactionType;
use InfyOm\Generator\Common\BaseRepository;

class TransactionTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'has_duration',
        'default_duration',
        'default_amout'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TransactionType::class;
    }
}
