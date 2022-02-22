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
        $country = $request->header('country') ? $request->header('country') : 'EG';
        config()->set('app.country', $country);

        $tours = Tour::where([['type','special'], ['status','1']])
            ->orderBy('order_no','asc')->orderBy('id','desc')->inRandomOrder()->paginate('8');

//        return response()->json(['success'=>'true','data'=> $tours]);
        return response()->json(['success'=>'true','data'=> ['tours'=>$tours]]);
    }


}
