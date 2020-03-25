<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use App\Events\Auth\UserRegistered;
use App\User\Traits\RelationshipTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\User\Traits\Functions\AuthFunction;
use App\User\Traits\Functions\ContactFunction;
use App\User\Traits\Functions\SavingFunction;
use App\User\Traits\Functions\WalletFunction;
use App\User\Traits\Transactions\SavingTrait;
use App\User\Traits\Transactions\WithdrawalTrait;
use App\User\Traits\Wallet\SmartWallet;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, RelationshipTrait, AuthFunction, ContactFunction, SavingFunction, WalletFunction, SavingTrait, WithdrawalTrait, SmartWallet ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tier', 'phone_number', 'verification', 'passport', 'tfa_option',
    ];
    /**
     * Dispatch event base on eloquent event
     */
    protected $dispatchesEvents = [
        'created' => [Registered::class , UserRegistered::class]
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','tfa_option','id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

// SELECT COUNT(id) as Count,MONTHNAME(created_at) as 'Month Name'
// FROM employees WHERE YEAR(created_at) = YEAR(CURDATE())
// GROUP BY YEAR(created_at),MONTH(created_at)