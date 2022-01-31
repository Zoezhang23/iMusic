<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    public function songs(){
        return $this->hasMany('App\Song');
    }
}
