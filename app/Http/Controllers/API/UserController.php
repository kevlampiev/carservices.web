<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $user = User::query()->find(1);
        $role = $user->roles;
        dd($role);
        return response()->json(User::query()->find(1)->get(), 200);
    }
}
