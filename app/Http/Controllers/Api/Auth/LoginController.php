<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Auth\Traits\AuthTrait;

class LoginController extends Controller
{
    use AuthTrait;
    public function login(Request $request)
    {
        $loginData = $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ], [
            'email.exists' => 'The user credentials were incorrect.'
        ]);
        if($this->attemptLogin($request)){
            $user =  User::where('email', $request->email)->first();
            return $this->sendLoginResponse($user);
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $accessToken = $request->user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);
        $accessToken->revoke();
        return response()->json(['message'=> 'log out completed'], 201);
    }
}