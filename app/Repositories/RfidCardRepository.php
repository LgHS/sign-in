<?php

namespace App\Repositories;

use App\RfidCard;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class RfidCardRepository
 * @package App\Repositories
 * @version April 10, 2019, 10:06 pm UTC
*/

class RfidCardRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'token',
        'uid',
        'user_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return RfidCard::class;
    }
}
