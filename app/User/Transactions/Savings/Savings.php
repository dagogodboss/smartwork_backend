<?php

namespace App\User\Transactions\Savings;

use App\Events\User\DepositedFunds;
use App\User\Traits\Transactions\SavingTrait;
// use App\User\Traits\Transactions\SavingTrait;
use Illuminate\Database\Eloquent\Model;

class Savings extends Model
{
    use SavingTrait;
    /** All General savings are newly inserted but only the 
     * current_balance is shown to the user.
     * Target and Fixed Savings can be new or updated ie top up
     */
    protected $fillable = ['user_id', 'deposit', 'purpose', 'is_target', 'target_amount', 'end_date','savings_id', 'earned_profit', 'current_balance', 'bonus_percent', 'is_recurrent', 'recurrent_interval_days', 'transaction_reference', 'method', 'account_type' ];
        
    /**
     * Dispatch event base on eloquent event
     */
    protected $dispatchesEvents = [
        'created' => DepositedFunds::class
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
