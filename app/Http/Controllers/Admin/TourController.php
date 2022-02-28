<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Hotel;
use App\Tour;
use App\TourPrices;
use App\TourGallery;
use App\User;
use App\Country;
use App\Governorate;

use Auth;
use App\Traits\imagesTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Str;

class TourController extends Controller
{
    use imagesTrait;

    public function index(){
        if(Auth::user()->hasRole(['vendor'])){
            $tours = Tour::where([['vendor_id',Auth::user()->id]])->paginate(10); // if vendor
        }else{
            $tours = Tour::paginate(10);
        }

        // dd($rooms);
        return view('admin.tour.index', compact('tours'));
    }

    public function create()
    {
        $vendors= User::whereRoleIs('vendor') -> get();
       $countries=Country::all();
       $gov=Governorate::all();


        return view('admin.tour.create', compact('vendors','countries','gov'));
    }

    public function store(Request $request)
    {

        $data = $request -> validate([
            'title_en' => 'required|string|max:100',
            'content_en' => 'string',
             'image' => 'required',
        ]);
        $except=['_token','add','image','arr'];
        foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value ){
            $except[]="title_".$key;
            $except[]="content_".$key;
            $except[]="address_".$key;
        }
        $data= $request->except($except);
        if(Auth::user()->hasRole(['admin','moderator'])){
            // dd(Auth::user()->id);
            $data['vendor_id'] = $request->vendor_id; //if admin
            }else if(Auth::user()->hasRole(['vendor'])){
                // dd(Auth::user()->id);
                $data['vendor_id'] = Auth::user()->id; // if vendor
            }
// dd($except);
            foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value ){
                $title = 'title_' . $key;
                $content = 'content_' . $key;
                $address = 'address_' . $key;
                $data['title'][$key]=$request->$title;
                $data['content'][$key]=$request->$content;
                $data['address'][$key]=$request->$address;

            }

// die();
        // $data['content']= ['en'=>$request->content_en, 'ar'=>$request->content_ar];
        // $data['address']= ['en'=>$request->address_en, 'ar'=>$request->address_ar];
        DB::beginTransaction();

        $tour = Tour::create($data);

        if ($request -> has('image')) {

            foreach($request->image as $i){

                $image = $this -> saveImages($i, 'images/tours');
                $gallery = new TourGallery();
                $gallery->tour_id = $tour->id;
                $gallery->image = $image;
                $gallery->save();
            }


        }

        if(isset($request->arr)){
            foreach($request->arr as $p){
                foreach($p['country'] as $i){
                $prices = new TourPrices();
                $prices->tour_id = $tour->id;
                $prices->ip = $i;
                $prices->price = $p['price'];
                $prices->ch_price = $p['ch_price'];
                $prices->save();
                }
            }

        }

        DB::commit();

        session() -> flash('success', trans('added successfully'));
        return redirect() -> route('tour.index');
    }



    public function edit($id)
    {
        $vendors= User::whereRoleIs('vendor') -> get();

        $tour = Tour ::find($id);
        $countries=Country::all();
        $gov=Governorate::all();



        return view('admin.tour.edit', compact('tour','vendors','countries','gov'));
    }

    public function update(Request $request, $id)
    {
        $data = $request -> validate([
            'title_en' => 'required|string|max:100',
            'content' => 'string',
        ]);

        $tour = Tour ::find($id);
        $except=['_token','add','image','arr'];
        foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value ){
            $except[]="title_".$key;
            $except[]="content_".$key;
            $except[]="address_".$key;
        }
        $data= $request->except($except);
// dd($except);
            foreach (LaravelLocalization::getSupportedLocales()  as $key=>$value ){
                $title = 'title_' . $key;
                $content = 'content_' . $key;
                $address = 'address_' . $key;
                $data['title'][$key]=$request->$title;
                $data['content'][$key]=$request->$content;
                $data['address'][$key]=$request->$address;

            }

        DB::beginTransaction();

        if ($request -> has('image')) {
            TourGallery::where('tour_id',$id)->delete();
            foreach($request->image as $i){

                $image = $this -> saveImages($i, 'images/tours');
                $gallery = new TourGallery();
                $gallery->tour_id = $tour->id;
                $gallery->image = $image;
                $gallery->save();
            }
        }
// dd($request->arr);
            // if(isset($request->arr)){
            //     TourPrices::where('tour_id',$id)->delete();
            //     foreach($request->arr as $p){
            //         $prices = new TourPrices();
            //         $prices->tour_id = $tour->id;
            //         $prices->ip = $p['country'];
            //         $prices->price = $p['price'];
            //         $prices->ch_price = $p['ch_price'];

            //         $prices->save();
            //     }
            // }
// dd($request->all());
            if(isset($request->arr)){
// dd($request->arr);
                 TourPrices::where('tour_id',$id)->delete();
                foreach($request->arr as $p){
                    //    dd($p['country']);
                    foreach($p['country'] as $i){
                    $prices = new TourPrices();
                    $prices->tour_id = $tour->id;
                    $prices->ip = $i;
                    $prices->price = $p['price'];
                    $prices->ch_price = $p['ch_price'];
                    $prices->save();
                    }
                }

            }


        $tour -> update($data);

        DB::commit();

        session() -> flash('success', trans('Updated Successfully'));
        return redirect() -> route('tour.index');
    }

    public function destroy($id)
    {
        if(!auth()->user()->hasRole(['admin','vendor']))
        {
            session() -> flash('Error', trans('Access Denied'));
            return redirect() -> route('tour.index');
        }
        $tour =    Tour ::find($id);


        DB::beginTransaction();

        if($tour -> image != 'default.png'){
            Storage ::disk('public_uploads') -> delete('images/tours' . $tour -> image);
        }
        $tour-> delete();
        TourGallery::where('tour_id',$id)->delete();

        DB::commit();

        session() -> flash('success', trans('deleted successfully'));
        return redirect() -> route('tour.index');
    }



}
