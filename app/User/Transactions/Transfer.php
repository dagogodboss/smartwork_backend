<?php

namespace App\User\Transactions;

use App\Notifications\System\AppNotification;
use App\User;
use App\User\SmartWallet;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    /**
     * Transfer Model this class allows users to send cash within
     * the system. Cash is sent to the users wallet not their savings account.
     * Money in the Wallet can be Withdraw, Save in any of the Savings, 
     * Use to purchase recharge, and others
     */
    protected $fillable = [
        'user_id', 'transfer_to', 'amount', 'account_number', 'is_recurrent', 'recurrent_days', 'transfer_id', 'add_to_contact'
    ];
    /**
     * Dispatch event base on eloquent event
    */
    protected $dispatchesEvents = [
        'created' => AppNotification::class
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function beneficiary(){
        return $this->belongsTo(User::class, 'transfer_to');
    }
    
    /**
     * @return Int $user_id
     * @param Int $account this the account Number of the user. 
     */
    public static function getReceiver($account){
        return SmartWallet::where('account_number', $account)->first()->user_id;
    }

    /**
     * saveTransfer save the transfer details, 
     * create a Notification and returns true
     * @param Int $receiver {user_id to receive the fund}
     * @param Object $request Illuminate\Http\Request { object that contains the transfer properties}
     * @return boolean true
    */
    
    public function saveTransfer(Int $receiver, Array $request){
        $transferData = array_merge($request, ['transfer_to' => $receiver, 'transfer_id' => generateTransferId()]);
        user()->transfer()->create($transferData);
        user()->notify(new AppNotification($this->getEmailAttribute($request)));
        // Reduce the sender account Balance
        user()->decrease_wallet($request['amount']);
        // increase the receiver wallet
        user($receiver)->increase_wallet($request['amount']);
        // Notify Receiver of the new transfer
        return user($receiver)->notify(new AppNotification($this->getReceiverEmailAttribute($receiver, $request)));
    }

    private function getReceiverEmailAttribute(Int $uuid, Array $request):object{
        $message =  str_replace("%account%", 
                                user()->smart_wallet->account_number, 
                                config('email.transfer.receiver.message'));
        $message = str_replace('%amount%', $request['amount'], $message);
        $message = str_replace('%balance%', 
                                user($uuid)->getBalance(), $message);
        return (object)[
            'subject' => config('email.transfer.receiver.subject'),
            'message' => $message,
            'greetings' => str_replace("%name%", user($uuid)->name, config('email.transfer.receiver.greetings'))
        ]; 
    }
    
    private function getEmailAttribute(Array $request):object{
        $message =  str_replace("%account%", $request['account_number'], config('email.transfer.message'));
        $message = str_replace('%amount%', $request['amount'], $message);
        $message = str_replace('%balance%', user()->getBalance(), $message);
        return (object)[
            'subject' => config('email.transfer.subject'),
            'message' => $message,
            'greetings' => str_replace("%name%", user()->name, config('email.transfer.greetings'))
        ]; 
    }

}
