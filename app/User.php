<?php

namespace App;

use App\Notifications\InitPasswordNotification;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait; // add this trait to your user model
    use FormAccessible;
    use Notifiable;
    use HasApiTokens;

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

    public function sendPasswordResetNotification($token) {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendPasswordInitNotification($token) {
        $this->notify(new InitPasswordNotification($token));
    }
}
