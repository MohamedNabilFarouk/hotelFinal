<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;
use Spatie\Translatable\HasTranslations;

class Room extends Model
{
    //
    use HasTranslations;
    public $translatable = ['title','content','address'];
    protected $guarded = [];

    protected $appends = [
        'title_api', 'address_api', 'content_api'
    ];

    public function getTitleApiAttribute()
    {
        $lang = app()->getLocale();
        if( isset($this->title->$lang)){
            return $this -> title->$lang;
        } else {
            return $this->title;
        } // end of if

    } // end of title api app lang

    public function getAddressApiAttribute()
    {
        $lang = app()->getLocale();
        if( isset($this->address->$lang)){
            return $this -> address->$lang;
        } else {
            return $this ->address;
        } // end of if

    } // end of address api app lang

    public function getContentApiAttribute()
    {
        $lang = app()->getLocale();
        if( isset($this->content->$lang)){
            return $this -> content->$lang;
        } else {
            return $this ->content;
        } // end of if

    } // end of content api app lang

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



    public function hotel(){
        return $this->belongsTo(Hotel::class,'hotel_id','id');
    }
    public function gallery(){
        return $this->hasMany(RoomGallery::class,'room_id','id');
    }
    public function prices(){
        return $this->hasMany(RoomPrices::class,'room_id','id');
    }


    // public function getImagesAttribute($value)
    // {
    //     return asset('images/rooms/' . $value);
    // } // end of get image attribute
}
