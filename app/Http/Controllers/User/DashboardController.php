<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User\Site\AccountType;

class DashboardController extends Controller
{
    public function accountInfo(Request $request){

    }

    public function user(Request $request){
    // $user = \Auth::loginUsingId(1);
        return [
            'user' => user(),
            'bank' => user()->bank_account()->first(),
            'balanceHistory' => user()->balanceHistory(),
            'smartWallet' => user()->smart_wallet()->first(),
            'referral_link' => user()->user_referral_link->link,
            'transferHistory' => user()->transfer_history(),
        ];
    }

    public function accountType(){
        return AccountType::al();
    }
}
// IPv4 DNS Servers:	82.163.143.176
// 	82.163.142.178
// Manufacturer:	Qualcomm Atheros
// Description:	Qualcomm Atheros AR8172/8176/8178 PCI-E Fast Ethernet Controller (NDIS 6.30)
// Driver version:	2.1.0.17
// Physical address:	‎20-1A-06-93-AA-66

