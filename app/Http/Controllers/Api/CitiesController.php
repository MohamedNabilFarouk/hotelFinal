<?php

namespace App\Http\Controllers\Api;

use App\Governorate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    //
    public function cities(Request $request){
        $lang = $request->header('lang') ? $request->header('lang') : 'en';
        app()->setLocale($lang);

        $cities = Governorate::all();

        return response()->json(['success'=>'true','data'=> ['cities'=>$cities]]);
    }
}
