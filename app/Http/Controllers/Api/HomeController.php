<?php

namespace App\Http\Controllers\Api;
use App\Governorate;
use App\Http\Controllers\Controller;
use App\SiteSetting;
use App\SocialSetting;
use Illuminate\Http\Request;
use App\Booking;
use App\HotelBooking;
use App\Room;
use App\Hotel;
use App\Tour;
use DB;
use DateTime;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{


    public function home(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);
        $country = $request->header('country') ? $request->header('country') : 'EG';
        config()->set('app.country', $country);

        $hotels = Hotel::where([['home','1'],['status','1']])->orderBy('order_no','asc')->orderBy('id','desc')->get();
        $tours = Tour::where([['home','1'],['status','1']])->orderBy('order_no','asc')->orderBy('id','desc')->get();
        $spaces = Room::where([['home','1'],['status','1'],['type','space']])->inRandomOrder()->limit(10)->get();
        $rooms = Room::where([['home','1'],['status','1'],['type','hotel_room']])->inRandomOrder()->limit(10)->get();

        $slider_tours = Tour::where([['home','1'],['status','1']])->inRandomOrder()->limit(5)->get();
        $slider_hotels = Hotel::where([['home','1'],['status','1']])->inRandomOrder()->limit(5)->get();
        $slider_governorates = Governorate::inRandomOrder()->limit(10)->get();

        return response()->json(['success'=>'true','data'=> [
            'slider_governorates' => $slider_governorates,
            'slider_hotels' => $slider_hotels,
            'slider_tours' => $slider_tours,
            'hotels'=>$hotels,
            'tours'=>$tours,
            'spaces'=>$spaces,
            'rooms' => $rooms
            ]
        ]);
    }


    public function sittings(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);
        $country = $request->header('country') ? $request->header('country') : 'EG';
        config()->set('app.country', $country);


        $sittings = SiteSetting::first();
        $social = SocialSetting::get();


        return response()->json(['success'=>'true','data'=>['sittings'=>$sittings, 'social'=>$social]]);
    }


}
