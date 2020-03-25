<?php

namespace App\User\Traits\Functions;
use App\Notifications\Auth\Verification\VerifyApiEmail;

/**
 * Authentication Function Trait
 */
trait AuthFunction{

    public function sendApiEmailVerificationNotification(){
        $this->notify(new VerifyApiEmail); // my notification
        return $this;
    }
    
    /*
     *
     * Send Otp Code to users through the medium set
     * @return bool true
     * 
    */
    public function sendOtpCode(){
        $this->setOtpCode()->sendCode();
        return true;
    }
    
    public function sendCode(){
        return true;
    }
    
    /**
     * Delete and Create a new Otp code
     * @return Object $this 
    */
    public function setOtpCode(){
    	$this->otpCode()->delete();
		$this->otpCode()->create([
			'token' => $this->generateToken(),
			]);
		return $this;
    }

    public function generateToken(){
        return rand(000000, 999999);
    }

    public function isValidToken($token){
        return ($this->otpCode()->first() !== null && $this->otpCode->token == $token ) ? $this->validateToken() : false;
    }

    protected function validateToken(){
        $this->otpCode->validated = \Carbon\Carbon::now();
        $this->otpCode->save(); 
        return true;
    }
    /**
     * This function deletes the current users otp code. 
     */
    public function deleteOtpToken(){
       return  $this->otpCode()->first()->delete();
    }
}
