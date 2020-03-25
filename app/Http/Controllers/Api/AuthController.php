<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {   
        $validatedUser = $request->validate([
            'name' => 'required| string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $validatedUser['password'] = Hash::make($request->password);
        $user = User::create($validatedUser);
        $accessToken = $user->createToken('authToken')->accessToken;
        return response(['user'=> $user, 'access_token'=> $accessToken]);
    }

    public function login(Request $request){
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if (!auth()->attempt($loginData)) {
            return response(['message'=> 'Invalid Credentials'], 500);
        }
        $user = auth()->user();
        $accessToken = $user->token('authToken');
        return response()->json(['user' => $user, 'access_token'=> $accessToken], 200);
    }
}
