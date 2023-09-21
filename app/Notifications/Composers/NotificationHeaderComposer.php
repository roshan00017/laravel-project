<?php

namespace App\Notifications\Composers;

use App\Http\Controllers\Grevience\NotificationController;
use App\Models\Grevience\Notification;
use Illuminate\View\View;

class NotificationHeaderComposer
{
    private Notification $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;

    }

    public function compose(View $view)
    {
        $totalNotification = NotificationController::getAllNotification();
        $totalComplaintNotification = NotificationController::getTotalNotificationByType('complaint');
        $totalSuggestionNotification = NotificationController::getTotalNotificationByType('suggestion');
        $totalIncidentNotification = NotificationController::getTotalNotificationByType('incident');
        $totalAppointmentNotification = NotificationController::getTotalNotificationByType('appointment');
        $view->with([
            'totalNotification' => $totalNotification,
            'totalComplaintNotification' => $totalComplaintNotification,
            'totalSuggestionNotification' => $totalSuggestionNotification,
            'totalIncidentNotification' => $totalIncidentNotification,
            'totalAppointmentNotification' => $totalAppointmentNotification,
        ]
        );

    }
}
