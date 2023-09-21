<?php

namespace App\Listeners;

use App\Events\RegisterSuchikritUserEvent;
use Illuminate\Support\Facades\Mail;

class RegisterSuchikritUserListener
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
    public function handle(RegisterSuchikritUserEvent $event)
    {
        Mail::send('backend.emailTemplate.registerSuchikritUser',
            [
                'full_name' => $event->getData()['full_name'],
                'email' => $event->getData()['email'],
                'mobile' => $event->getData()['mobile'],
                'otp' => $event->getData()['otp_code'],
                'token' => $event->getData()['otp_token'],
            ], function ($message) use ($event) {
                $message->to($event->getData()['email'], trans('agenda.from'))
                    ->subject(trans('suchikritFrontEnd.title'));
                $message->from(config('mail.from.address'), 'e-office');
            });
    }
}
