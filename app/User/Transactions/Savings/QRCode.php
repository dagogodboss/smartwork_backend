<?php

namespace App\User\Savings;

use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{
    protected $fillable = [
        'user_id', 'qr_code', 'amount', 'description', 'img_link', 'product_name'
    ];
    /**
     * Email Notification to the merchant concerning trans
     * Split Payment and Wallet 
     * Merchant Transaction History
     * Merchant Page/Promotional Tools/E-commerce setup 
     * with Tenancy 
     * Webpage for merchant
     * Scanner for Merchant
     */
}
