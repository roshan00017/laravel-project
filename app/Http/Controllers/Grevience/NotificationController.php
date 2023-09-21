<?php

namespace App\Http\Controllers\Grevience;

use App\Http\Controllers\Controller;
use App\Models\Grevience\Notification;
use App\Repositories\CommonRepository;
use App\Repositories\Grievance\NotificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use PDF;

class NotificationController extends Controller
{
    protected NotificationRepository $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {

        $this->notificationRepository = $notificationRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['page_url'] = '/notifications';
            $data['page_route'] = 'notifications';
            $data['results'] = $this->notificationRepository->getAllNotifications($request);
            $data['show_button'] = true;
            $data['page_title'] = getLan() == 'np' ? 'सूचना सूची' : 'Notification List';
            $data['request'] = $request;
            $data['custom_print'] = true;

            if (@$_GET['pdf'] == 't') {
                // dd('pdf',$_GET);
                $pdf = PDF::loadView('backend.grevience.suggestions.pdflist', $data);

                return $pdf->inline('list.pdf');
            }

            $data['load_css'] = [
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',
                'plugins/select2/css/select2.css',

            ];
            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_app.min.js',
                'js/custom_search.js',
            ];

            return view('backend.grevience.notifications.index', $data);
        } catch (\Exception $e) {
            //check for encryption format to decryption
            if ($e->getMessage() == 'The payload is invalid.') {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return back();
            }
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public static function getAllNotification()
    {
        $query = Notification::query();

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($query);
        }

        return $query->whereNull('notification_read_date_np')
            ->count();
    }

    public static function getTotalNotificationByType($type)
    {
        $query = Notification::query();

        if (userInfo()->role_id > 2) {
            CommonRepository::checkClientId($query);
        }

        return $query->where('notify_type', $type)->whereNull('notification_read_date_np')
            ->count();
    }
}
