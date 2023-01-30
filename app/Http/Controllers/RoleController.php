<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    // public function index()
    // {
    //     $roles = Role::all();
    //     return view('roles.index', compact('roles'));
    // }


    public function create(Request $request)
    {
        $name = $request->input('name');
        $role = Role::create(['name' => $name]);
        return redirect()->back()->with('status', 'Role created successfully');

    }
    
}
