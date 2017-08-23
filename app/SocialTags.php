<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialTags extends Model
{
    public function socialTags()
    {
        return $this->belongsTo('App\User');
    }
}
