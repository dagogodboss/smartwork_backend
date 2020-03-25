<?php

namespace App\User;

use App\User\Traits\Wallet\SmartWallet as WalletTrait;
use Illuminate\Database\Eloquent\Model;

class SmartWallet extends Model
{
    use WalletTrait;

    protected $fillable = [
        'user_id', 'account_signature', 'account_number','account_name', 'balance'
    ];
    
    public function user(){
        return $this->belongsTo('App/User');
    }
}
