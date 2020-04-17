<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Detail;
use App\Kind;
use App\city;
class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function users()
    {
        return $this->hasManyThrough('App\User' , 'App\Role');
    }
}
