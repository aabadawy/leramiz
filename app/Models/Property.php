<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;

use Illuminate\Support\Str;


class Property extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'properties';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = ['square'];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function setImageAttribute($value)
    {
        $attribute_name = "image";
        $disk = config('public'); // or use your own disk, defined in config/filesystems.php
        $destination_path = "public/photos"; // path relative to the disk above

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = 'no.jpg';
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);

        // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';

        // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

        // 3. Delete the previous image, if there was one.
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // 4. Save the public path to the database
        // but first, remove "public/" from the path, since we're pointing to it from the root folder
        // that way, what gets saved in the database is the user-accesible URL
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;

        }
    }

    public static function boot()
    {
    parent::boot();
    static::deleting(function($obj) {
    \Storage::disk('public')->delete($obj->image);
            // Catching City.....
            $city = City::where('id',$obj->city_id)->first();
            // Modifing Number Of Properties
            $city->number_of_properties -- ;
            $city->save();
            // Catching Kind.......
            $kind = Kind::where('id',$obj->kind_id)->first();
            // Modifing Number Of Properties
            $kind->number_of_properties -- ;
            $kind->save();

    });
        static::created(function ($obj) {
            // Catching City.....
            $city = City::where('id',$obj->city_id)->first();
            // Modifing Number Of Properties
            $city->number_of_properties ++ ;
            $city->save();
            // Catching Kind.......
            $kind = Kind::where('id',$obj->kind_id)->first();
            // Modifing Number Of Properties
            $kind->number_of_properties ++ ;
            $kind->save();
        });
        static::updated(function ($obj){
            // Catching City.....
            if($obj->isDirty('city_id')){
                $city = City::where('id',$obj->city_id)->first();
            // Modifing Number Of Properties
            $city->number_of_properties ++ ;
            $city->save();
            }
            if($obj->isDirty('kind_id'))
            {
                // Catching Kind.......
                $kind = Kind::where('id',$obj->kind_id)->first();
                // Modifing Number Of Properties
                $kind->number_of_properties ++ ;
                $kind->save();

            }
        });
    }
    

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

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



    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
