<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;

class Space extends Model
{
    //
    protected $guarded = [];
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
    // $this->attributes['slug'] = Str::slug($value);

    if (static::whereSlug($slug = Str::slug($value))->exists()) {

        $slug = $this->incrementSlug($slug);
    }

    $this->attributes['slug'] = $slug;

    }

    public function incrementSlug($slug) {

        $original = $slug;
    
        $count = 2;
    
        while (static::whereSlug($slug)->exists()) {
    
            $slug = "{$original}-" . $count++;
        }
    
        return $slug;
    
    }

    public function getImageAttribute($value)
    {
        return asset('images/spaces/' . $value);
    } // end of get image attribute

    public function vendor(){
        return $this->belongsTo(User::class,'vendor_id','id');
    }
    public function type(){
        return $this->belongsTo(SpaceType::class,'type_id','id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function gallery(){
        return $this->hasMany(SpaceGallery::class,'space_id','id');
    }
}
