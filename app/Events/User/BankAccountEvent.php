<?php

namespace App\Events\User;

use App\Events\NotifiableEvent;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class BankAccountEvent implements NotifiableEvent
{
    use Dispatchable,  SerializesModels;
    public $bank;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function getEventName(): string{
        return 'BankAccountEvent';
    }

    public function getEventDescription(): string{
        return 'This event is fired whenever a user adds a bank details,  or updates it.';
    }

    public function __construct($bank)
    {   
        $this->bank = $bank;
    }
}
