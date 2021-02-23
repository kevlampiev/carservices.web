<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $request->has('search') ?
            $this->userRepository->search($request) :
            $this->userRepository->getAll();
        return view('admin.users', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.userCreate');
    }

    public function store(Request $request)
    {
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
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'role' => 'required|in:user,owner,admin'
        ]);
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);
        $result = $user->save();
        if ($result) {
            return redirect()->route('admin.users.index');
        }
        return redirect()->route('admin.users.edit', $user);
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Удаление пользвателя невозможно, он связан с записями в других таблицах');
        }
        return back();
    }

    public function changePass(User $user)
    {
        return view('admin.userPassEdit', ['user' => $user]);
    }

    public function updatePass(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return redirect()->route('admin.users.index');
        }
        return back();
    }
}
