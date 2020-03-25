<?php

namespace App\Listeners\User;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\System\AppNotification;

class NotifyUser
{
    use InteractsWithQueue;
    private $eventObject;
    /**
     * Create the event listener.
     *
     * @return void
     */
    // public function __construct($eventObject)
    // {
    //     $this->$eventObject = $eventObject;
    // }

    /**
     * Handle the event.
     *
     * @param    $event
     * @return void
     */
    public function handle($eventObject)
    {
        dd($eventObject);
        $user = request()->user();
        $user->notify(
            new AppNotification(
                getEmailProperty($eventObject->message)
            )
        );
    }
}
