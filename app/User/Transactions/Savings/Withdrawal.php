<?php
namespace App\User\Transactions\Savings;

use App\User;
use App\Events\User\WithdrawalEvent;
use App\User\Traits\Transactions\WithdrawalTrait;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model {
    use WithdrawalTrait;

    protected $fillable = [
        'user_id', 'savings_id', 'initial_balance', 'withdraw', 'current_balance'
    ];

    // protected $dispatchEvents  = [
    //     'created' => WithdrawalEvent::class,
    // ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function savings(){
        return $this->belongsTo(Savings::class);
    }
}
