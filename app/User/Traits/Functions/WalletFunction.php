<?php 

namespace App\User\Traits\Functions;

/**
 * Wallet Function Traits all the functions that affect a user wallet
 */
trait WalletFunction
{
    public function increase_wallet($deposit){
        $this->smart_wallet()->increment('balance', $deposit);
        return $this;
    }

    public function decrease_wallet($amount){
        $this->smart_wallet()->decrement('balance', $amount);
        return $this;
    }
    
}
