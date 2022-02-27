<?php

namespace App\Http\Controllers\Api;
use App\Governorate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\HotelBooking;
use App\Room;
use App\Hotel;
use App\Tour;
use App\Currency;
use App\SavedSearch;
use DB;
use DateTime;
use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SiteController extends Controller
{

    public function SpecialTours(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);
        $country = $request->header('country') ? $request->header('country') : 'EG';
        config()->set('app.country', $country);

        $tours = Tour::where([['type','special'], ['status','1']])
            ->orderBy('order_no','asc')->orderBy('id','desc')->inRandomOrder()->paginate('8');

//        return response()->json(['success'=>'true','data'=> $tours]);
        return response()->json(['success'=>'true','data'=> ['tours'=>$tours]]);
    }

    public function lang_currency(Request $request){
      $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);
        $country = $request->header('country') ? $request->header('country') : 'EG';
        config()->set('app.country', $country);
        $currencies = Currency::all();
        $langs= LaravelLocalization::getSupportedLocales();
        // $langs= LaravelLocalization::getSupportedLocales();
        // dd($langs);
        return response()->json(['success'=>'true','data'=> ['currencies'=>$currencies,'langs'=>$langs]]);
        
    }
    public function savedSearch($request){
        $data=$request->all();
        // dd($data);
        SavedSearch::create($data);
    }

}
