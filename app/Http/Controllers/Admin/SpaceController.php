<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Space;
use App\User;
use App\Country;
use App\SpaceType;
use App\SpaceGallery;
use Auth;
use App\Traits\imagesTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Str;
use File;

class SpaceController extends Controller
{
    use imagesTrait;

    public function index(){
        $spaces = Space::paginate(10);
        return view('admin.space.index', compact('spaces'));
    }

    public function create()
    {
        $vendors= User::whereRoleIs('vendor') -> get();
        $countries = Country::all();
        $types  = SpaceType::all();
        return view('admin.space.create', compact('vendors','countries','types'));
    }

    public function store(Request $request)
    {
        // dd($request->veg);
        $data = $request -> validate([
            'title' => 'required|string|max:100',
            'content' => 'string',
            'images' => 'required',
            'type_id' => 'required',
            'number' => 'required',
            'max_guest' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
        ]);

        if(Auth::user()->hasRole(['admin','moderator'])){
            $data['vendor_id'] = Space::where('status','1')->get(); //if admin
            }else if(Auth::user()->hasRole(['vendor'])){
                $data['vendor_id'] = Auth::user()->id; // if vendor
            }

        $data = $request->except(['_token','add','images']);
        // if ($request -> has('image')) {
        //     $image = $this -> saveImages($request -> images, 'images/spaces');
        //     $data['images'] = $image;
        // }

        DB::beginTransaction();

        $space= Space::create($data);
        // dd($data);
        if ($request -> has('images')) {

            foreach($request->images as $i){

                $image = $this -> saveImages($i, 'images/spaces');
                $gallery = new SpaceGallery();
                $gallery->space_id = $space->id;
                $gallery->image = $image;
                $gallery->save();
            }


        }

        DB::commit();


        session() -> flash('success', trans('added successfully'));
        return redirect() -> route('space.index');
    }



    public function edit($id)
    {
        $vendors= User::whereRoleIs('vendor') -> get();
        $countries = Country::all();
        $types  = SpaceType::all();

        $space = Space ::find($id);

        return view('admin.space.edit', compact('space','vendors','countries','types'));
    }

    public function update(Request $request, $id)
    {
        $data = $request -> validate([
            'title' => 'required|string|max:100',
            'content' => 'string',
        ]);

        $space = Space ::find($id);
        $data = $request->except(['_token','add','images']);
        DB::beginTransaction();

        // if ($request -> has('image')) {
        //     if($hotel -> image != 'default.png'){
        //         Storage ::disk('public_uploads') -> delete('spaces/' . $space -> image);
        //     }
        //     $image = $this -> saveImages($request -> image, 'images/spaces');
        //     $data['image'] = $image;
        // }
        if ($request -> has('images')) {
           SpaceGallery::where('space_id',$id)->delete();
            foreach($request->images as $i){

                $image = $this -> saveImages($i, 'images/spaces');
                $gallery = new SpaceGallery();
                $gallery->space_id = $space->id;
                $gallery->image = $image;
                $gallery->save();
            }





        }

        $space -> update($data);

        DB::commit();

        session() -> flash('success', trans('Updated Successfully'));
        return redirect() -> route('space.index');
    }

    public function destroy($id)
    {
        if(!auth()->user()->hasRole(['admin','vendor']))
        {
            session() -> flash('Error', trans('Access Denied'));
            return redirect() -> route('space.index');
        }
        $space =    Space ::find($id);


        DB::beginTransaction();

        // dd($sapce->gallery);

        $space-> delete();
        SpaceGallery::where('space_id',$id)->delete();

        DB::commit();
        session() -> flash('success', trans('deleted successfully'));
        return redirect() -> route('space.index');
    }



}
