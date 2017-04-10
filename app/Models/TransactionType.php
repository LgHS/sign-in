<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TransactionType
 * @package App\Models
 * @version February 17, 2017, 10:41 pm UTC
 */
class TransactionType extends Model
{
    use SoftDeletes;

    public $table = 'transaction_types';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'has_duration',
        'default_duration',
        'default_amout'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'has_duration' => 'boolean',
        'default_duration' => 'integer',
        'default_amout' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    
}
