<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Currency;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    //
    public function index(){
        $currencies = Currency::paginate(10);
        return view('admin.currency.index',compact('currencies'));
    }

    public function create(){
        return view('admin.currency.create');
    }

    public function store(Request $request){

        $data = $request -> validate([
            'name' => 'required|string|max:100',
            'abbr' => 'required',
            'ex_rate' => 'required|numeric',
            
        ]);
        $data = $request->except(['_token','add']);
    
       
        Currency::create($data);
        session() -> flash('success', trans('added successfully'));
        return redirect() -> route('currency.index');
    }
    public function edit($id){
        $currency = Currency::findOrFail($id);
        return view('admin.currency.edit',compact('currency'));
    }
    public function update($id,Request $request){

        $data = $request -> validate([
            'name' => 'required|string|max:100',
            'abbr' => 'required',
            'ex_rate' => 'required|numeric',
            
        ]);
        $data = $request->except(['_token','add']);
        $currency = Currency ::find($id);
        $currency -> update($data);
        session() -> flash('success', trans('Updated Successfully'));
        return redirect() -> route('currency.index');
    }
    
    public function destroy($id)
    {
        $currency = Currency ::find($id);
     
        $currency-> delete();
        session() -> flash('success', trans('deleted successfully'));
        return redirect() -> route('currency.index');

    }


}
