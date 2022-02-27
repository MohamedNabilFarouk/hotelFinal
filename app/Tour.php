<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Str;
class Tour extends Model
{
    use HasTranslations;

    public $translatable = ['title','content','address'];
    // protected $fillable=['title','content','address','vendor_id','image',]
    protected $guarded = [];
    protected $appends = [
        'title_api', 'address_api', 'content_api', 'price_api'
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

    public function getImageAttribute()
    {
        return isset($this->gallery[0]) ? $this->gallery[0]->image : "";
    } // end of get image attribute

    public function getPriceApiAttribute()
    {
        if ($this->attributes['type'] == 'special'){
            // check country to get price
            if (config()->get('app.country') == 'EG'){
                return [
                'price' => $this->attributes['price'],
                'ch_price' => $this->attributes['child_price']
                ];
            }else{
                $tour_price = TourPrices::where([
                    ['ip', '=', config()->get('app.country')],
                    ['tour_id', '=', $this->id]
                ])->select('price', 'ch_price')->first();

                $price = isset($tour_price) ? $tour_price->price : null;
                $ch_price = isset($tour_price) ? $tour_price->ch_price : null;
                return [
                    'price' => $price,
                    'ch_price' => $ch_price
                ];
            }
        }else{
            if (config()->get('app.country') == 'EG'){
                return [
                    'price' => $this->attributes['price'],
                    'ch_price' => $this->attributes['child_price']
                ];
            }else{
                return [
                    'price' => $this->attributes['world_price'],
                    'ch_price' => $this->attributes['world_price']
                ];
            }
        }
    } // end of get image attribute

    public function vendor(){
        return $this->belongsTo(User::class,'vendor_id','id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }

    public function gallery(){
        return $this->hasMany(TourGallery::class,'tour_id','id');
    }

    public function prices(){
        return $this->hasMany(TourPrices::class,'tour_id','id');
    }
    public function gov(){
        return $this->belongsTo(Governorate::class,'gov_id','id');
    }
}
