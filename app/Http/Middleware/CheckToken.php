<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $query = User::query()->where('token', $request->token)->get();
        if (!$query) {
            return response()->json('You have not authorized yet');
        }
        return $next($request);
    }
}
