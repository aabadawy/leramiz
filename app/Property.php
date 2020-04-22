<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
   

    

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function details()
    {
        return $this->belongsToMany('App\Models\Detail');
    }
    

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function kind()
    {
        return $this->belongsTo('App\Models\kind');
    }

}
