<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MacAddresses extends Model
{
    //
    protected $fillable = ["user_id", "mac_address", "alias"];
}
