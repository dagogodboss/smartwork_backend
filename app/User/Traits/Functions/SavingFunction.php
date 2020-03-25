<?php
namespace App\User\Traits\Functions;
/**
 * All the functions performed by a user that affects their savings
 */

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

trait SavingFunction{
   
    /**
     * Saves a transaction 
     * @param object $transaction
     * @return object self
    */
    public function saveCreditTransaction($transaction){
        $this->transactions()->create([
            'signature' => $transaction->savings_id,
            'description' => $transaction->purpose,
            'amount' => $transaction->deposit,
            'type' => 'credit',
            'sub_type' => $transaction->method,
            'destination' => $this->smart_wallet->account_number,
            'transaction_reference' => $transaction->transaction_reference,
        ]);
        return $this;
    }

    public function transfer_history(){
        $transfers =  $this->transfer()->oldest()->get()->load('beneficiary');
        $beneficial =  [];
        foreach ($transfers as $value) {
            array_push($beneficial, [
                'key'=> $value->id,
                'name'=> $value->beneficiary->name,
                'transfer'=> $value->created_at->diffForHumans(),
                'image'=> $value->avatar,
                'status'=> 'Paid'
            ]);
        }
        return ($beneficial);
    }

    public function balanceHistory(){
        $sql = 'SELECT SUM(amount) as "balance", MONTHNAME(created_at) as "name" FROM transaction_details  GROUP BY MONTH(created_at)';
        return DB::select($sql);
    } 

    public function reduceSavings($params){
        //first we get the exact amount if it is possible
        // otherwise we get all the rows that sums up to this $amount
        // lastly we reduce the amount by the individual row 
        if(!$this->reduceSavingByAmount($params->amount)):                          if(!$this->reduceSavingByMatchedSum($params->amount)) {
                $this->reduceSavingByRow($params->amount);
                return $this;
            }
            return $this;
        endif;
    }

}
