<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function properties()
    {
        return $this->hasMany('App\property');
    }

}
