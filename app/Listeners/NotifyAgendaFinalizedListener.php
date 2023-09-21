<?php

namespace App\Listeners;

use App\Events\NotifyAgendaFinalizedEvent;
use Illuminate\Support\Facades\Mail;

class NotifyAgendaFinalizedListener
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
    public function handle(NotifyAgendaFinalizedEvent $event)
    {
        Mail::send('backend.emailTemplate.notifyAgenda',
            [
                'memberName' => $event->getData()['memberName'],
                'agendaList' => $event->getData()['agendaList'],
                'meetingInfo' => $event->getData()['meetingInfo'],
                'memberInfo' => $event->getData()['memberInfo'],
            ], function ($message) use ($event) {
                $message->to($event->getData()['email'], trans('agenda.from'))
                    ->subject(trans('agenda.title'));
                $message->from(config('mail.from.address'), 'स्मार्ट अफिस व्यवस्थापन प्रणाली');
            });
    }
}
