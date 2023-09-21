<?php

namespace App\Listeners;

use App\Events\RegisterUsersEvent;
use App\Events\UserCreated;
use Illuminate\Support\Facades\Mail;

class NotifyUserCreatedListener
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
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(RegisterUsersEvent $event)
    {
        Mail::send('backend.emailTemplate.addUser',
            [
                'fullName' => $event->getUserData()['full_name'],
                'userName' => $event->getUserData()['login_user_name'],
                'email' => $event->getUserData()['email'],
                'mobile_no' => $event->getUserData()['mobile_no'],
                'password' => $event->getUserData()['user_password'],
            ], function ($message) use ($event) {
                $message->to($event->getUserData()['email'], 'Info')
                    ->subject(trans('auth.addUser.title'));
                $message->from('support@admin.com', 'Info');
            });
    }
}
