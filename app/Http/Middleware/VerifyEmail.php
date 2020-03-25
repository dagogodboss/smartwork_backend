<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class VerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(! $request->user() && $request->email){
            $user = \App\User::where('email', $request->email)->first();
            if($user instanceof MustVerifyEmail &&
            ! $user->hasVerifiedEmail()){
                abort(403, 'Your email address is not verified. Please check your inbox for the validation Email');
            }
        }
        if (($request->user() instanceof MustVerifyEmail &&
            ! $request->user()->hasVerifiedEmail())) {
                abort(403, 'Your email address is not verified. Please check your inbox for the validation Email');
        }
        return $next($request);
    }
}
