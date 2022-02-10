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
use DB;
use DateTime;
use Illuminate\Support\Facades\App;

class SiteController extends Controller
{

    public function SpecialTours(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);
        $tours = Tour::where([['status','1'],['type','special']])->orderBy('id','desc')->get();
        return response()->json(['success'=>'true','data'=> $tours]);
    }


}
