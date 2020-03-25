<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserOAuth extends Controller
{
    public function sendOtp(){
        user()->sendOtpCode();
        return jsonResponse(['message' => 'Confirm the OTP ']);
    }
}
