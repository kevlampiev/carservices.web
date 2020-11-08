<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
//        dd(User::all());
        return response()->json(User::all());
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
        return response()->json(User::all());
    }

    public function update(Request $request, User $user)
    {
        $user = $user->fill($request->all());
        if($user->save()) {
            return response()->json(200);
        }
        return response()->json(400);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
