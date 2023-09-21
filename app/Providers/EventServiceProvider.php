<?php

namespace App\Providers;

use App\Events\AgendaFinalizedEvent;
use App\Events\AgendaFinalizedFileEvent;
use App\Events\AppointmentConfirmEvent;
use App\Events\ComplaintMailEvent;
use App\Events\NotifyAgendaFinalizedEvent;
use App\Events\PasswordResetByAdminEvent;
use App\Events\PasswordResetEvent;
use App\Events\RegisterSuchikritUserEvent;
use App\Events\RegisterUsersEvent;
use App\Listeners\AgendaFinalizedFileListener;
use App\Listeners\AgendaFinalizedListener;
use App\Listeners\AppointmentConfirmListener;
use App\Listeners\ComplaintMailListener;
use App\Listeners\NotifyAgendaFinalizedListener;
use App\Listeners\NotifyUserCreatedListener;
use App\Listeners\PasswordResetByAdminListener;
use App\Listeners\PasswordResetListener;
use App\Listeners\RegisterSuchikritUserListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RegisterUsersEvent::class => [
            NotifyUserCreatedListener::class,
        ],
        PasswordResetEvent::class => [
            PasswordResetListener::class,
        ],

        PasswordResetByAdminEvent::class => [
            PasswordResetByAdminListener::class,
        ],

        AgendaFinalizedEvent::class => [
            AgendaFinalizedListener::class,
        ],
        NotifyAgendaFinalizedEvent::class => [
            NotifyAgendaFinalizedListener::class,
        ],
        AgendaFinalizedFileEvent::class => [
            AgendaFinalizedFileListener::class,
        ],
        AppointmentConfirmEvent::class => [
            AppointmentConfirmListener::class,
        ],
        ComplaintMailEvent::class => [
            ComplaintMailListener::class,
        ],

        RegisterSuchikritUserEvent::class => [
            RegisterSuchikritUserListener::class,
        ],

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

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
