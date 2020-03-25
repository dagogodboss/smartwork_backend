<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\User\Transactions\Transfer;
use App\Http\Controllers\Controller;

class TransferController extends Controller
{
    public function transferFunds(Request $request){
        $this->validate($request, [
            'account_number' => 'required|digits:10|exists:smart_wallets,account_number',
            'amount' => 'required|min:1|numeric',
            'add_to_contact' => 'boolean',
            'recurrent_days' => 'numeric', 
            'is_recurrent' => 'boolean',
        ],[
            'amount.min' => 'You can\'t transfer zero fund',
            'account_number.exists' => 'The Account number is not correct please check it.',
        ]);
        $transfer_to = Transfer::getReceiver($request->account_number);
        user()->add_toContact($request->add_to_contact, $transfer_to);
        if(validateAmount($request->amount, 'smart_wallets', 'balance')) {
            $transfer = new Transfer();
            $transfer->saveTransfer($transfer_to, $request->all());
            return jsonResponse([
                'transfer' => user()->transfer()->get(),
                'message' => message('transfer_success')
            ]);
        } 
        return invalidRequest(message('transfer_invalid'));
    }  
    // Transfer Notification and transfer message, Save Transfer
}
// {"account_number":"6622121121","amount":"2000"}