<?php

namespace App\User;

use App\Events\User\BankAccountEvent;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
        
    /**
     * Dispatch event base on eloquent event
     */
    // protected $dispatchesEvents = [
    //   'created' => BankAccountEvent::class,
    //   'updated' => BankAccountEvent::class
    // ];

    protected $fillable = [
      'user_id',  'account_number', 'account_name', 'bank_name'
    ]; 

    public function user(){
      return $this->belongsTo('App/User');
    }
}
