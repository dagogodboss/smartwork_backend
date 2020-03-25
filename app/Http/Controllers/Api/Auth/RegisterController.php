<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\RegisteredUser;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'phone_number' => 'required|regex:/(0)[0-9]{9}/|min:11',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ], [
            'password.confirmed' => 'The password does not match.',
            'phone_number' => 'Please enter a valid phone Number'
        ]);

        try {
            $user = $this->create($request->all());
            $user->sendApiEmailVerificationNotification();
            $user->getReferrals();
            event(new \App\Events\UserReferred(request()->cookie('ref'), $user));
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json([
                "error" => "invalid_credentials",
                "message" => $e->getMessage()
            ], 401);
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User 
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => bcrypt($data['password']),
        ]);
    }
}