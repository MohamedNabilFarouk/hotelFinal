<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Attribute;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\imagesTrait;

class AttributeController extends Controller
{
    use imagesTrait;
    //
    public function index(){
        $attributes = Attribute::paginate(10);
        return view('admin.attribute.index',compact('attributes'));
    }

    public function create(){
        return view('admin.attribute.create');
    }

    public function store(Request $request){

        $data = $request -> validate([
            'title' => 'required|string|max:100',
            'service' => 'required',
            
        ]);
        $data = $request->except(['_token','add']);
        if ($request -> has('icon')) {
            $image = $this -> saveImages($request -> icon, 'images/attributes');
            $data['icon'] = $image;
        }
    if(isset($request->service)){
        foreach($request->service as $s){
            $data['service'] = $s;
         Attribute::create($data);
        }
    }
      
        
        session() -> flash('success', trans('added successfully'));
        return redirect() -> route('attribute.index');
    }
    public function edit($id){
        $attribute = Attribute::findOrFail($id);
        return view('admin.attribute.edit',compact('attribute'));
    }
    public function update($id,Request $request){

        $data = $request -> validate([
            'title' => 'required|string|max:100',
           
            
        ]);
        $data = $request->except(['_token','add']);
        if ($request -> has('icon')) {
            $image = $this -> saveImages($request -> icon, 'images/attributes');
            $data['icon'] = $image;
        }
        $attribute = Attribute ::find($id);

       
            $attribute -> update($data);
        



       
        session() -> flash('success', trans('Updated Successfully'));
        return redirect() -> route('attribute.index');
    }
    
    public function destroy($id)
    {
        $attribute = Attribute ::find($id);
     
        $attribute-> delete();
        session() -> flash('success', trans('deleted successfully'));
        return redirect() -> route('attribute.index');

    }


}
