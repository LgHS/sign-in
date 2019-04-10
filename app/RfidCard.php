<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RfidCard extends Model
{
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
        'uid' => 'required'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
