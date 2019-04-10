<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Webpatser\Uuid\Uuid;

class RfidCard extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "name",
        "token",
        "uid",
        "user_id"
    ];


    protected $visible = [
        "id",
        "uid",
        "token"
    ];

    public static $rules = [
        'name' => 'max:255',
        'uid' => 'required|numeric'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->token = (string) Uuid::generate(4);
        });
    }
}
