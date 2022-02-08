<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable=[
        'name',
        'des',
        'price',
        'image',
    ];

    public function getImageAttribute($value)
    {
        return asset('images/products/' . $value);
    } // end of get image attribute
}
