<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ToursController extends Controller
{
    public function tours(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);


        $tours = Tour::where([['status','1']])->orderBy('order_no','asc')->orderBy('id','desc')->inRandomOrder()->paginate('8');

        return response()->json(['success'=>'true','data'=> ['tours'=>$tours]]);
    }

    public function singleTour(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);

        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:tours,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>'false', 'data'=>$validator->messages()]);
        }

        $tour = Tour::find($request->id);
        return response()->json(['success'=>'true','data'=> ['tour'=>$tour]]);
    }
}
