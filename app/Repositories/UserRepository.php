<?php


namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::query()->paginate(7);
    }

    public function search(Request $request)
    {
        return User::query()
            ->where('name', 'like', "%$request->search%")
            ->orWhere('email', 'like', "%$request->search%")
            ->orWhere('email', 'like', "%$request->search%")
            ->paginate(7)
            ->withPath("?".$request->getQueryString());
    }
}
