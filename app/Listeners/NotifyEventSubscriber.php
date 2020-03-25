<?php

namespace App\Listeners;

class NotifyEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event) {}

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) {}

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\Auth\UserLoginSubscribe@onUserLogin'
        );

        // $events->listen(
        //     'Illuminate\Auth\Events\Logout',
        //     'App\Listeners\UserLoginSubscribe@onUserLogout'
        // );
    }

}