<?php
namespace App\User\Traits; 
use App\User\Transactions\Savings\Savings;
trait RelationshipTrait{ 
   
    public function smart_wallet(){
        return $this->hasOne('App\User\SmartWallet');
    }   
    
    public function savings(){
        return $this->hasMany(Savings::class);
    }

    public function withdrawals(){
        return $this->hasMany('App\User\Transactions\Savings\Withdrawal');
    }
    
    public function transactions(){
        return $this->hasMany('App\User\Transactions\TransactionDetails');
    }

    public function support(){
        return $this->hasMany('App\User\Message\ContactSupport');
    }

    public function getReferrals()
    {
        $referralProgram =  new \App\User\ReferralProgram();
        return $referralProgram->all()->map(function ($program) {
            $referralLink =  new \App\User\ReferralLink();
            return $referralLink->getReferral($this, $program);
        });
    }
    public function user_referral_link(){
        return $this->hasOne('App\User\ReferralLink');
    }
        
    public function credit_card_payment(){
        return $this->hasOne('App\CreditCardPayment');
    }

    public function bank_account(){
        return $this->hasOne('App\User\BankAccount');
    }

    public function otpCode(){
        return $this->hasOne('App\User\OtpCode');
    }

    public function user_referral_relation(){
        return $this->hasOne('App\User\ReferralRelationship', 'referrer_user_id');
    }
    public function transfer(){
        return $this->hasMany('App\User\Transactions\Transfer');
    }
}