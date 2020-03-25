<?php

namespace App\Http\Controllers\Api\Auth\Traits;

use Illuminate\Http\Request;
/**
 * Contain all the function
 */
trait AuthTrait
{
    
    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return jsonResponse([
            "error" => "invalid_credentials",
            "message" => "Please check your login details details and try again."
        ], 405);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  $user
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse($user)
    {
        return jsonResponse([
            'user' => $user,
            'user_id'=> \Hash::make($user->id), 
            'auth_step' => $user->tfa_option,
        ],200);
    }
    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin($request){
        return (auth()->attempt($request->only('email', 'password'))) ? true : false;
    }

    protected function invalidOtpToken(){
        return jsonResponse([
            "error" => "invalid_credentials",
            "message" => "The token you supplied is not correct"
        ], 405);
    }

    protected function sendOtpResponse($token){
        return jsonResponse([
            // 'user' => request()->user(),
            'token' => $token->accessToken
        ], 200);
    }
}
