<?php

namespace App;

use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait; // add this trait to your user model
    use FormAccessible;

    protected $fillable = [
        'date_of_birth', 'lastName',
        'firstName', 'gender', 'address',
        'postcode', 'city', 'country',
        'phone', 'member_since', 'is_public',
        'is_active'
    ];

    protected $hidden = [
        'id', 'username', 'email', 'password', 'remember_token', 'token_valid', 'totp', 'uuid'
    ];

    public function formDateOfBirthAttribute($value) {
        if(!$value) return '';
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function formMemberSinceAttribute($value) {
        if(!$value) return '';
        return Carbon::parse($value)->format('d/m/Y');
    }
}
