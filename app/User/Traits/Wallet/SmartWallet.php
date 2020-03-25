<?php
namespace App\User\Traits\Wallet;

/**
 * 
 */
trait SmartWallet
{
    

    public function getBalance():int{
        return $this->smart_wallet->balance;
    }

    public static function  createWallet($user){
        return Self::create([
            'user_id' => $user->id,
            'account_signature' => signature($user),
            'account_number' => generateRandomNumber(),
            'account_name' => $user->name,
        ]);
    }
    
    /**
     * check if the wallet exists in store
     * @param int $uuid
     * @return Object single row of the query
    */
    
    public static function wallet_exists($uuid){
        return Self::where('account_number', $uuid)->first();
    }
    
    /**
     * generate Credit Card Details
     * @return Object 
    */
    
    public static function generateCreditCard(){
        
    }
}
