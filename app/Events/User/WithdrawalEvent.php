<?php

namespace App\Events\User;

use App\Events\NotifiableEvent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class WithdrawalEvent implements NotifiableEvent
{
    use Dispatchable, SerializesModels;
    // public $bank;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function getEventName(): string{
        return 'WithdrawalEvent';
    }

    public function getEventDescription(): string{
        return 'This event is fired whenever users withdraws from their account';
    }
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user, $amount;
    
    public function __construct($user, $amount)
    {
        $this->user = $user;
        $this->amount = $amount;
    }
}
