<?php

namespace App;

use App\Notifications\InitPasswordNotification;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use FormAccessible;
    use Notifiable;
    use HasApiTokens;

    use SoftDeletes, EntrustUserTrait {
        SoftDeletes::restore insteadof EntrustUserTrait;
        EntrustUserTrait::restore insteadof SoftDeletes;
    }

    protected $dates = ['deleted_at'];

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

    // https://github.com/Zizaco/entrust/issues/480
    public function restore() {
        $this->sfRestore();
        Cache::tags(Config::get('entrust.role_user_table'))->flush();
    }
}
