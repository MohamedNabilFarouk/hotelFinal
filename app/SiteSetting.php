<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $guarded =[];

    public $timestamps = true;

    protected $appends = [
        'title', 'about', 'address', 'city', 'country', 'meta_title', 'meta_description', 'meta_keyword'
    ];

//    public function getLogoAttribute($value)
//    {
//        return asset('images/site/' . $value);
//    } // end of get name attribute

//    public function getFaviconAttribute($value)
//    {
//        return asset('images/site/' . $value);
//    } // end of get name attribute

    public function getTitleAttribute(){
        $lang = app()->getLocale();
        return $this[ 'title_'.$lang];
    }
    public function getAboutAttribute(){
        $lang = app()->getLocale();
        return $this[ 'about_'.$lang];
    }
    public function getAddressAttribute(){
        $lang = app()->getLocale();
        return $this[ 'address_'.$lang];
    }
    public function getCityAttribute(){
        $lang = app()->getLocale();
        return $this[ 'city_'.$lang];
    }
    public function getCountryAttribute(){
        $lang = app()->getLocale();
        return $this[ 'country_'.$lang];
    }
    public function getMetaTitleAttribute(){
        $lang = app()->getLocale();
        return $this[ 'meta_title_'.$lang];
    }
    public function getMetaDescriptionAttribute(){
        $lang = app()->getLocale();
        return $this[ 'meta_description_'.$lang];
    }
    public function getMetaKeywordAttribute(){
        $lang = app()->getLocale();
        return $this[ 'meta_keyword_'.$lang];
    }
}
