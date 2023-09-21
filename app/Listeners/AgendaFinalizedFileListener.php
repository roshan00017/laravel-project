<?php

namespace App\Listeners;

use App\Events\AgendaFinalizedFileEvent;
use Illuminate\Support\Facades\Mail;

class AgendaFinalizedFileListener
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
    public function handle(AgendaFinalizedFileEvent $event)
    {
        Mail::send('backend.emailTemplate.agendaFinalizedFile',
            [
                'memberName' => $event->getData()['memberName'],
                'meetingInfo' => $event->getData()['meetingInfo'],

            ], function ($message) use ($event) {
                $message->to($event->getData()['email'], trans('agenda.from'))
                    ->subject(trans('meeting.final_verdict.agenda_final_file_title'));
                $message->from(config('mail.from.address'), 'स्मार्ट अफिस व्यवस्थापन प्रणाली');
            });
    }
}
