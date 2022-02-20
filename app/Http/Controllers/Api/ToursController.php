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

    public function searchTour(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);

        $validator = Validator::make($request->all(), [
            'city' => 'required|numeric|exists:governorates,id',
            'date' => 'required|date|after:yesterday'
        ]);

        if ($validator->fails()) {
            return response()->json(['success'=>'false', 'data'=> $validator->messages()]);
        }

        $tours = Tour::where([
            ['gov_id',$request->city],
            ['status','1']
        ])->orderBy('order_no','asc')->orderBy('id','desc')->inRandomOrder()->paginate('8');

        return response()->json(['success'=>'true','data'=> ['tours'=>$tours]]);

    }

    public function filterTours(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);

        $country = $request->header('country') ? $request->header('country') : 'EG';

        $price = array_map(function($value) { return (int)$value; }, $request->price);
        $gov_id = array_map(function($value) { return (int)$value; }, $request->gov_id);
        $star_rate = array_map(function($value) { return (int)$value; }, $request->star_rate);

        $tours = Tour::where([['status', '=', '1']])->whereHas('prices', function($q) use($price, $country) {

                $q->where('ip', '=', $country)->whereBetween('price', $price);

        })->where(function ($query) use ($star_rate, $gov_id) {
            $query->whereIn('gov_id', $gov_id)->whereIn('star_rate', $star_rate);
        })->orderBy('order_no','asc')->orderBy('id','desc')->inRandomOrder()->paginate(8);

        return response()->json(['success'=>'true','data'=> ['tours'=>$tours]]);
    }


}
