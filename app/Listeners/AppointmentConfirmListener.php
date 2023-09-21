<?php

namespace App\Listeners;

use App\Events\AppointmentConfirmEvent;
use Illuminate\Support\Facades\Mail;

class AppointmentConfirmListener
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
    public function handle(AppointmentConfirmEvent $event)
    {
        $data = $event->getData();

        $name = $event->getData()['name'];
        $appointmentNo = $event->getData()['appointment_no'];

        Mail::send('backend.emailTemplate.appoitnmentConfirm', [
            'name' => $name,
            'appointment_no' => $appointmentNo,
        ], function ($message) use ($data) {
            $message->from(config('mail.from.address'), 'e-office');
            $message->to($data['email'])->subject(trans('appointment.appointment_confirm'));
        });
    }
}
