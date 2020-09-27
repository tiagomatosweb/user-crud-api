<?php

namespace App\Providers;

use App\Events\UserCreated;
use App\Events\UserDeleted;
use App\Events\UserUpdated;
use App\Listeners\SendUserCreatedNotificationToAdmin;
use App\Listeners\SendUserDeletedNotificationToAdmin;
use App\Listeners\SendUserUpdatedNotificationToAdmin;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserCreated::class => [
            SendUserCreatedNotificationToAdmin::class,
        ],
        UserUpdated::class => [
            SendUserUpdatedNotificationToAdmin::class,
        ],
        UserDeleted::class => [
            SendUserDeletedNotificationToAdmin::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
