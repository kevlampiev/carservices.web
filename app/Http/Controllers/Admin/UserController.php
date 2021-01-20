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
        $users = User::query()->paginate(7);
        return view('admin.users', ['users' => $users ]);
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
        $user -> fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        $result = $user->save();
        if($result) {
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
        try {
            $user->delete();
        }
        catch (\Exception $e) {
            return back()->with('error', 'Удаление пользвателя невозможно, он связан с записями в других таблицах');
    }

        return back();
    }
}
