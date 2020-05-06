<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

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

    public function isOwner()
    {
        if(Auth::guest())
            return false ;
        else
            return $this->user->id == Auth::user()->id; 
    }
}
