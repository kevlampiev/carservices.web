<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
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
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique',
            'password' => 'required|alpha_dash|min:8',
            'role' => 'required|in:user,owner,admin'
        ]);
        $user = $user->fill($request->all());
        $result = $user->save();
        if ($result) {
            return response()->json(200);
        }
        return response()->json(500);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
