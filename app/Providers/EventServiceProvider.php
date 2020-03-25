<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\Auth\Verification\ApiSendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\Auth\UserRegistered;
use App\Events\NotifiableEvent;
use App\Listeners\Auth\GenerateUserWallet;
use App\Events\User\DepositedFunds;
use App\Listeners\User\DepositedFunds as AppDepositedFunds;
use App\Listeners\User\NotifyUser;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            ApiSendEmailVerificationNotification::class,
        ],
        UserRegistered::class => [
            GenerateUserWallet::class,
        ],
        DepositedFunds::class => [
            AppDepositedFunds::class
        ],
        NotifiableEvent::class => [
            NotifyUser::class
        ],
        'App\Events\UserReferred' => [
            'App\Listeners\RewardUser',
        ],
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
    */
    protected $subscribe = [
        'App\Listeners\NotifyEventSubscriber',
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
