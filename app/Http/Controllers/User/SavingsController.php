<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User\Site\AccountType;

class SavingsController extends Controller
{
    /**
     * Display a listing of the resource Target Savings.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTargetSavings(Request $request)
    {
        return $request->user()->targetSavings();
    }

    /**
     * Display a listing of the resource General Savings.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGeneralSavings(Request $request)
    {
        return $request->user()->generalSavings();
    }

    /**
     * Display a listing of the resource Fixed Savings.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFixedSavings(Request $request)
    {
        return $request->user()->fixedSavings();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = $this->validate($request,[
            'account_type' => 'required|string',
            'end_date' => 'date',
            'method' => 'required',
            'recurrent' => 'boolean',
            'purpose' => 'string|min:4',
            'target_amount' => 'numeric|min:50',
            'is_target' => 'boolean',
            'deposit' =>'required|numeric|min:50',
            'is_recurrent ' => 'boolean',
            'recurrent_intervals_days' => 'numeric',
            'transaction_reference' => 'required|string',
        ]);
        $setData = $this->setOtherField($attribute);
        user()->savings()->create($setData);
        return jsonResponse([
            'deposits' => user()->savings()->get(),
            'message' => message('deposit_success')
        ]);
    }
    /**
     * Set The default fields of the form
     * @param array $attribute  
     * @return array 
    */
    protected function setOtherField($attribute){
        $attribute['account_type'] = getAccountType($attribute['account_type']);
        return array_merge($attribute, [
            'current_balance' => $attribute['deposit'],
            'savings_id' => SavingId($attribute['account_type']),
            'bonus_percent' => getBonus($attribute['account_type']),
        ]);
    }

    /**
     * Withdraw from the users savings
     * @param \Illuminate\Http\Request
     * @param int $id
     * @return \Illuminate\Http\Response
    */
    public function withdraw(Request $request){
        $this->validate($request, [
            'amount' => 'required|numeric',
            'account_type' => 'required',
        ]);
        return validateWithdrawal($request) ? 
                user()->withdraw($request) :  
                invalidRequest(message('withdrawal_failed'));
        //the initial_balance must be greater than the withdrawal amount 
        // the initial balance  
    }
    
    /** 
     * @return Object of all the users total Savings
    */
    public function getUserSavings(){
       return request()->user()->savings()->get();
    }
}
