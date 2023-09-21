<?php

namespace App\Listeners;

use App\Events\PasswordResetByAdminEvent;
use Illuminate\Support\Facades\Mail;

class PasswordResetByAdminListener
{
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
     * @param  \App\Events\UserCreated  $event
     * @return void
     */
    public function handle(PasswordResetByAdminEvent $event)
    {
        Mail::send('backend.emailTemplate.passwordResetInfo',
            [
                'userName' => $event->getData()['userName'],
                'password' => $event->getData()['password'],
                'token' => $event->getData()['token'],
                'login_user_name' => $event->getData()['login_user_name'],
                'type' => $event->getData()['type'],
            ], function ($message) use ($event) {
                $message->to($event->getData()['email'], 'Info')
                    ->subject(trans('auth.passwordReset.title'));
                $message->from('support@admin.com', 'Info');
            });
    }
}
