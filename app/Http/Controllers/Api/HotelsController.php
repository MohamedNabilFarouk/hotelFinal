<?php

namespace App\Http\Controllers\Api;

use App\Hotel;
use App\Http\Controllers\Controller;
use App\RoomPrices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class HotelsController extends Controller
{
    public function hotels(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);

        $hotels = Hotel::where([['status','1']])->orderBy('order_no','asc')->orderBy('id','desc')->inRandomOrder()->paginate('8');

        return response()->json(['success'=>'true','data'=> ['hotels'=>$hotels]]);
    }

    public function singleHotel(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);

        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:hotels,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>'false', 'data'=>$validator->messages()]);
        }

        $hotel = Hotel::find($request->id);
        return response()->json(['success'=>'true','data'=> ['hotel'=>$hotel]]);
    }

    public function searchHotel(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);

        $validator = Validator::make($request->all(), [
            'city' => 'required|numeric|exists:governorates,id',
            'date_from' => 'required|date|after:yesterday',
            'date_to' => 'required|date|after:today',
            'adult' => 'required|numeric|min:1',
            'children' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>'false', 'data'=> $validator->messages()]);
        }

        $hotels = Hotel::where([
            ['status','1'],
            ['gov_id',$request->city]
        ])->orderBy('order_no','asc')->orderBy('id','desc')->inRandomOrder()->paginate('8');

        return response()->json(['success'=>'true','data'=> ['hotels'=>$hotels]]);
    }

    public function filterHotels(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);

        $country = $request->header('country') ? $request->header('country') : 'EG';

        $price = array_map(function($value) { return (int)$value; }, $request->price);
        $gov_id = array_map(function($value) { return (int)$value; }, $request->gov_id);
        $star_rate = array_map(function($value) { return (int)$value; }, $request->star_rate);

        $hotels = Hotel::where([['status', '=', '1']])->whereHas('rooms', function($q) use($price, $country) {

                $q->whereHas('prices', function($q) use($price, $country) {
                    $q->where('ip', '=', $country)->whereBetween('price', $price);
                });

        })->where(function ($query) use ($star_rate, $gov_id) {
                $query->whereIn('gov_id', $gov_id)
                    ->whereIn('star_rate', $star_rate);
            })->orderBy('order_no','asc')->orderBy('id','desc')->inRandomOrder()->paginate(8);

        return response()->json(['success'=>'true','data'=> ['hotels'=>$hotels]]);
    }

    public function hotelRoomsMinMaxPrice(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);

        $country = $request->header('country') ? $request->header('country') : 'EG';

        $min_price = RoomPrices::where('ip','=', $country)->select('price as min_price')->orderBy('price','asc')->first();
        $max_price = RoomPrices::where('ip','=', $country)->select('price as max_price')->orderBy('price','desc')->first();

        $min_price = $min_price->min_price;
        $max_price = $max_price->max_price;
        return response()->json(['success'=>'true', 'data'=> [
           'min_price' => $min_price,
            'max_price' => $max_price]
        ]);
    }
}
