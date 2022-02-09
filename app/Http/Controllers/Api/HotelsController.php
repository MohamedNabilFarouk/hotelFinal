<?php

namespace App\Http\Controllers\Api;

use App\Hotel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
}
