<?php

namespace App\Listeners\User;

use App\Events\User\DepositedFunds as DepositEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\System\AppNotification;

class DepositedFunds
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DepositEvent  $event
     * @return void
     */
    public function handle(DepositEvent $event)
    {
        $user = user();
        // Save the New Balance to the wallet 
        // $user->increase_wallet($event->savings->deposit);
        $user->saveCreditTransaction($event->savings);
        $user->notify(
            new AppNotification(
                getEmailProperty('deposit', $event->savings->deposit)
            )
        );
    }
}
