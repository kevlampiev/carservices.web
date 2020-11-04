<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = new User();
        try {
            $this->validate($request, User::rules());
            $user->password = Hash::make($request->post('password'));
            $token = $user->createToken('carservices Personal Access Client')->accessToken;
            $user->fill($request->only(['name', 'email']))
                ->save();
            return response()->json([
                'status' => 201,
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }

    }


    public function login()
    {
//        $client = DB::table('oauth_clients')
//            ->where('password_client', true)
//            ->first();
//
//        $data = [
//            'grant_type' => 'password',
//            'client_id' => $client->id,
//            'client_secret' => $client->secret,
//            'username' => request('username'),
//            'password' => request('password'),
//        ];
//
//        $request = Request::create('/oauth/token', 'POST', $data);
//
//        return app()->handle($request);
        try {
            $user = User::query()->where('email',request()->post('email'))->first();
            if (!$user) {
                return response()->json(['status'=>403,
                        'error'=>'Пользователь с email '.request()->post('email').' не найден']);
            };
            if (Hash::check(request()->post('password'),$user->password)) {
                $token = $user->createToken('carservices Personal Access Client')->accessToken;
                return response()->json([
                    'status' => 201,
                    'token' => $token,
                ]);
            } else {
                return response()->json([
                    'status' => 403,
                    'error' => 'Неверная пара логин + пароль']);
            }
        } catch(\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


    public function logout()
    {
        $accessToken = auth()->user()->token();

        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();

        return response()->json(['status' => 200]);
    }


}
