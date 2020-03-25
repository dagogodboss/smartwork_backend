<?php
namespace App\User\Traits\Transactions;

use App\User\Site\AccountType;

/**
 * This Trait Hold all the functions for savings
 */
trait SavingTrait
{
    
    /**
     * reasonsList a List of the reasons why users save
     * @return array 
    */
    public function reasonsList(){
        // get list of purpose from the purpose field 
        return array_pluck($this->all(), 'purpose');
    }

    public function targetSavings(){
        $this->where('account_type', 'target')->get();
    }

    public function generalSavings(){
        return $this->where('account_type', 'general')->get();
    }

    public function fixedSavings(){
        return $this->where('account_type', 'fixed')->get();
    }   

    public function totalCurrentBalance(string $type){
        return $this->savings()->where('account_type', $type)->get()->sum('current_balance');
    }

    public function reduceSavingByAmount($amount){
        $saving =  $this->findBy('current_balance', $amount);
        if(!$saving){
            return false;
        }
        $saving->decrement('current_balance', $amount);
        return true;
    }

    public function reduceSavingByMatchedSum($amount){
        return false;
    }

    public function reduceSavingByRow($amount){
        $balance_row = $this->savings()->get();
        $amount = $amount;
        for ($i=0; $i < $amount; $i++) { 
            if($balance_row[$i]->current_balance >= $amount){
                $balance_row[$i]->current_balance = $balance_row[$i]->current_balance -  $amount;
                $balance_row[$i]->save();
                $amount =  $amount - $balance_row[$i]->current_balance;
            }else{
                $amount =  $amount - $balance_row[$i]->current_balance;
                $balance_row[$i]->current_balance =  0;
                $balance_row[$i]->save();
            }
        }
        return  true;
    }

    public function findBy(string $filed, string $value){
        return $this->savings()->where($filed, $value)->first();
    }
    
}
