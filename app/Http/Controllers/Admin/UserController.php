<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users', ['users' => User::all()]);
    }

    public function create()
    {
        return view('admin.userCreate');
    }

    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:user,owner,admin'
        ]);

        $user = new User;
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        $result = $user->save();
        if ($result) {
            return redirect()->route('admin.users.index');
        }
        return redirect()->back();
    }

    public function show(User $user)
    {
    }

    public function edit(User $user)
    {
        return view('admin.userEdit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
//        dd($request);
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,owner,admin'
        ]);
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        $result = $user->save();
//        dd($user);
        if ($result) {
            return redirect()->route('admin.users.index');
        }
        return redirect()->route('admin.users.edit', $user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
