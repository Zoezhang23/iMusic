<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    // hide the attributes
    protected $hidden = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function singer()
    {
        return $this->belongsTo('App\Singer');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }
}
