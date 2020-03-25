<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Controllers\Api\Auth\Traits\AuthTrait;
use Illuminate\Support\Facades\Auth;

class VerificationApiController extends Controller{
    protected $redirectTo = '/dashboard';
    use VerifiesEmails, AuthTrait;

    /**
    * Mark the authenticated user’s email address as verified.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */

    public function verify(Request $request) {
        Auth::loginUsingId($request->id);
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        return redirect($this->redirectPath())->with('verified', true);

    }

    /**
    * Resend the email verification notification.
    *
    * @param \Illuminate\Http\Request $request
    * @return \Illuminate\Http\Response
    */

    public function resend(Request $request){
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' =>'User already have verified email!'], 500);  
        }
        $request->user()->sendEmailVerificationNotification();
        return response()->json(['message' => 'The notification has been resubmitted'], 200);
    }

    public function validateOtp(Request $request){
        $request->validate([
            'token' => 'required|numeric|min:6',
            'email' => 'email|required',
        ]);
        $user = User::where('email', $request->email)->first();
        if($user->isValidToken($request->token)){
            $user->deleteOtpToken();
            $token = $user->createToken('Smart Motion Personal Access Client');
            return $this->sendOtpResponse($token);
        }
        return $this->invalidOtpToken();
    }
}