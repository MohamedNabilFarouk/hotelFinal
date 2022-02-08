<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpaceType extends Model
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
        return asset('images/hotels/' . $value);
    } // end of get image attribute

  
}
