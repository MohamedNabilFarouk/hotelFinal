<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelGallery extends Model
{
    protected $table='hotel_gallaries';
    public function getImageAttribute($value)
    {
        return asset('images/hotels' . $value);
    } // end of get image attribute
}
