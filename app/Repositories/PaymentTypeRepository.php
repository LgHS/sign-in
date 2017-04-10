<?php

namespace App\Repositories;

use App\Models\PaymentType;
use InfyOm\Generator\Common\BaseRepository;

class PaymentTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PaymentType::class;
    }
}
