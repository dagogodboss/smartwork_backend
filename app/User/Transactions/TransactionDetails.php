<?php

namespace App\User\Transactions;

use Illuminate\Database\Eloquent\Model;
/**
 * The Transaction Details of a user.
 * transaction types include debit or credit 
 * transaction sub types bank_debit, card_credit, transfer_debit,
 * transfer_credit, airtime_credit, bank_credit,
 *  
 * @var string
*/
class TransactionDetails extends Model
{
    protected $fillable = [
        'user_id', 'signature', 'description', 'amount', 'type', 'sub_type', 'destination', 'transaction_reference'
    ];

    public function user(){
        return $this->belongsTo('App/User');
    }
}
