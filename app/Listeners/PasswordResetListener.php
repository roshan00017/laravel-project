<?php

namespace App\Listeners;

use App\Events\PasswordResetEvent;
use Illuminate\Support\Facades\Mail;

class PasswordResetListener
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
    public function handle(PasswordResetEvent $event)
    {
        Mail::send('backend.emailTemplate.passwordResetLink',
            [
                'userName' => $event->getData()['userName'],
                'token' => $event->getData()['token'],
            ], function ($message) use ($event) {
                $message->to($event->getData()['email'], 'Info')
                    ->subject(trans('auth.passwordReset.title'));
                $message->from('support@admin.com', 'Info');
            });
    }
}
