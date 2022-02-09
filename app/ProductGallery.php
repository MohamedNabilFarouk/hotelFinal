<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelGallery extends Model
{
    public function getImageAttribute($value)
    {
        return asset('images/hotels' . $value);
    } // end of get image attribute
}
