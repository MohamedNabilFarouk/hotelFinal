<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourGallery extends Model
{
    //
    public function getImageAttribute($value)
    {
        return asset('images/tours/' . $value);
    } // end of get image attribute
}
