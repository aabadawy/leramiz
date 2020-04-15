<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function details()
    {
        return $this->belongsToMany('App\Detail');
    }
    

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function kind()
    {
        return $this->belongsTo('App\kind');
    }
}
