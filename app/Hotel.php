<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Str;
use Spatie\Translatable\HasTranslations;

class Hotel extends Model
{
    //
    use HasTranslations;
    public $translatable = ['title','content','address'];

    protected $guarded = [];

    protected $appends = [
        'title_api', 'address_api', 'content_api', 'min_price', 'data', 'max_price'
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
    public function getMinPriceAttribute()
    {
        $room = Room::where([['hotel_id', '=', $this->id]])
            ->orderBy('price', 'asc')->first();

        if ($room){
            if (config()->get('app.country') == 'EG'){
                if ($room->on_sale == '1'){
                    return $room->sale_price;
                }else{
                    return $room->price;
                }
            }else{
                $room_price = RoomPrices::where([
                    ['ip', '=', config()->get('app.country')],
                    ['room_id', '=', $room->id]
                ])->select('price')->first();
                $price = isset($room_price) ? $room_price->price : null;
                return $price;
            }
        }
    }
    public function getMaxPriceAttribute()
    {
        $room = Room::where([['hotel_id', '=', $this->id]])
            ->orderBy('price', 'desc')->first();

        if ($room){
            if (config()->get('app.country') == 'EG'){
                if ($room->on_sale == '1'){
                    return $room->sale_price;
                }else{
                    return $room->price;
                }
            }else{
                $room_price = RoomPrices::where([
                    ['ip', '=', config()->get('app.country')],
                    ['room_id', '=', $room->id]
                ])->select('price')->first();
                $price = isset($room_price) ? $room_price->price : null;
                return $price;
            }
        }
    }

    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
    // $this->attributes['slug'] = Str::slug($value);

    if (static::whereSlug($slug = Str::slug($value))->exists()) {

        $slug = $this->incrementSlug($slug);
    }

    $this->attributes['slug'] = $slug;

    }


    public function getDataAttribute(){
        return [
            'gallery' => $this->gallery,
            'country' => $this->country,
            'gov' => $this->gov,
            'rooms' => $this->rooms,
            'roomsCount' => count($this->rooms),
            'spaces' => $this->spaces,
            'spacesCount' => count($this->spaces),
        ];
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

    public function vendor(){
        return $this->belongsTo(User::class,'vendor_id','id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function gov(){
        return $this->belongsTo(Governorate::class,'gov_id','id');
    }

    public function rooms(){
        return $this->hasMany(Room::class,'hotel_id','id')->where('type','hotel_room')
            ->with('prices');
    }
    public function spaces(){
        return $this->hasMany(Room::class,'hotel_id','id')->where('type','space')
            ->with('prices');
    }

    public function gallery(){
        return $this->hasMany(HotelGallery::class,'hotel_id','id');
    }
    public function recomm(){

    }
}
