<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
//        dd(User::all());
        return view('users', ['users' => User::all()]);
    }

//    public function create()
//    {
//        //
//    }

//    public function store(Request $request)
//    {
//        //
//    }

//    public function show(User $user)
//    {
//
//    }

    public function edit(User $user)
    {
        return view('userEdit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->all();

        $user = $user->fill($data);
        $result = $user->save();
//        $result = $user->fill($request->all())->save();
        return view('users');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
