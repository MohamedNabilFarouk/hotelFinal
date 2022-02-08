<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\imagesTrait;

use App\Governorate;

use Illuminate\Http\Request;

class govController extends Controller
{
    //
    use imagesTrait;
    public function index(){
        $govs = Governorate::paginate(10);
        return view('admin.gov.index',compact('govs'));
    }

    public function create(){
        return view('admin.gov.create');
    }

    public function store(Request $request){

        $data = $request -> validate([
            'name_en' => 'required|string|max:100',
            'name_ar' => 'required',
            'image' => 'required',

        ]);
        $data = $request->except(['_token','add']);
        if ($request -> has('image')) {
            $image = $this -> saveImages($request -> image, 'images/gov');
            $data['image'] = $image;
        }

        Governorate::create($data);
        session() -> flash('success', trans('added successfully'));
        return redirect() -> route('governorate.index');
    }
    public function edit($id){
        $gov = Governorate::findOrFail($id);
        return view('admin.gov.edit',compact('gov'));
    }
    public function update($id,Request $request){

        $data = $request -> validate([
            'name_en' => 'required|string|max:100',
            'name_ar' => 'required',
            'image' => 'required',

        ]);
        $data = $request->except(['_token','add']);
        if ($request -> has('image')) {
            $image = $this -> saveImages($request -> image, 'images/gov');
            $data['image'] = $image;
        }
        $gov = Governorate ::find($id);
        $gov -> update($data);
        session() -> flash('success', trans('Updated Successfully'));
        return redirect() -> route('governorate.index');
    }

    public function destroy($id)
    {
        $gov = Governorate ::find($id);

        $gov-> delete();
        session() -> flash('success', trans('deleted successfully'));
        return redirect() -> route('governorate.index');

    }


}
