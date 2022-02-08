<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(){
        $roles = Role::paginate(10);
//         dd($roles);
        return view('admin.permissions.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $data = $request -> validate([
            'name' => 'required|string|max:100',
            'display_name' => 'nullable|string|max:200',
            'description' => 'nullable|string|max:200',
            'permisions' => 'required|array|min:1'
        ]);



        session() -> flash('success', trans('added successfully'));
        return redirect() -> route('permissions.index');
    }

}
