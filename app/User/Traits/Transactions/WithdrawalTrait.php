<?php
namespace App\User\Traits\Transactions;

use App\Jobs\User\WithdrawHttpRequest;
use App\Notifications\User\Transaction\WithdrawalNotification;
use Illuminate\Support\Facades\Notification;

/**
 * Withdrawal Transaction
 */
trait WithdrawalTrait{
    /**
     * withdraw() we will set the initial balance 
     * to the user to the total current balance, 
     * then insert the amount sent as the withdrawal and final 
     * @param int $amount this is the specific amount to be withdraw
     * @return an object with success message in it.
    */ 
    
    public function withdraw(object $params){
        $account_type = \App\User\Site\AccountType::getAccountType($params->account_type);
        $current_balance  = $this->totalCurrentBalance($account_type);
        $this->withdrawals()->create([
            'savings_id' => $account_type,
            'initial_balance' => $current_balance, 
            'withdraw' => $params->amount,
            'current_balance' => $current_balance - $params->amount,
        ]);
        $this->reduceSavings($params);

        //create new job to run on the background to initialize the withdrawal from smart motion wallet.
        dispatch(new WithdrawHttpRequest($this, $this->bank_account, $params->amount));
        // Create Transaction history.
        $this->createTransactionHistory($params);
        // send Notification to user concerning withdrawal
        $tranDetails = (object)$params->all();
        Notification::send($this, new WithdrawalNotification($tranDetails));

        return jsonResponse([
            'message' => message('withdrawal_success'),
        ]);
    }

    public function validateWithdrawal(int $amount, string $type){
        return ($amount !== 0 && $this->totalCurrentBalance($type) >= $amount 
                && $this->totalWithdrawSync($type)) ?  true : false;
    }
    public function totalWithdrawSync(int $type){
        if(!$this->withdrawals()->get()) {
            return true;    
        } 
        if($this->withdrawals()->latest()->first()->current_balance == $this->totalCurrentBalance($type)) {
            return true;
        } 
        return  false;
    }
    public function debitTransactionHistory(object $params){
    }
    
    public function createTransactionHistory(object $params){
        $this->transactions()->create(
            [
                'signature' => $params->account_type,
                'description' => 'Withdrawal',
                'amount' => $params->amount,
                'type' => 'debit',
                'sub_type' => 'App Transfer',
                'destination' => $this->smart_wallet->account_number,
                'transaction_reference' => $params->transaction_reference,
            ]);
    }
}
