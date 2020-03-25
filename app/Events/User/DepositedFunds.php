<?php

namespace App\Events\User;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class DepositedFunds
{
    use Dispatchable,  SerializesModels;
    public $savings;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($savings)
    {   
        $this->savings = $savings;
    }
}
