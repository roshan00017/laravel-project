<?php

namespace App\Listeners;

use App\Events\ComplaintMailEvent;
use Illuminate\Support\Facades\Mail;

class ComplaintMailListener
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
     * @return void
     */
    public function handle(ComplaintMailEvent $event)
    {
        $data = $event->getData();

        $name = $data['name'];
        $complaintNo = $data['complaint_no'];

        Mail::send('backend.emailTemplate.grievanceInfo',
            [
                'name' => $name,
                'complaint_no' => $complaintNo,
            ], function ($message) use ($data) {
                $message->from(config('mail.from.address'), 'स्मार्ट अफिस व्यवस्थापन प्रणाली');
                $message->to($data['email'])->subject('गुनासो दर्ता जानकारी');
            });
    }
}
