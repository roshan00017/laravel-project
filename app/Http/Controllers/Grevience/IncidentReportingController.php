<?php

namespace App\Http\Controllers\Grevience;

use App\Facades\NepaliDate;
use App\Http\Controllers\Controller;
use App\Models\Grevience\IncidentReporting;
use App\Models\Grevience\Notification;
use App\Repositories\Grievance\IncidentReportingRepository;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use PDF;

class IncidentReportingController extends Controller
{
    protected IncidentReportingRepository $incidentReportingRepository;

    public function __construct(IncidentReportingRepository $incidentReportingRepository)
    {

        $this->incidentReportingRepository = $incidentReportingRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['page_url'] = '/incidentReporting';
            $data['page_route'] = 'incidentReporting';
            $data['results'] = $this->incidentReportingRepository->getAllIncidentReportings($request);
            $data['show_button'] = true;
            $data['page_title'] = getLan() == 'en' ? 'Incident Reportings' : ' स्थलगत सूचना ';
            $data['request'] = $request;
            $data['custom_print'] = true;

            if (@$_GET['pdf'] == 't') {
                // dd('pdf',$_GET);
                $pdf = PDF::loadView('backend.grevience.incidentReporting.pdflist', $data);

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
            $data['filePath'] = IncidentReporting::FILE_UPLOAD_PATH;

            return view('backend.grevience.incidentReportings.index', $data);
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

    public function show(Request $request, $id)
    {
        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = IncidentReporting::query()->find($hashIdValue[0]);
                $data['page_url'] = '/incidentReporting';
                $data['page_title'] = getLan() == 'np' ? 'स्थलगत सूचना' : 'Incident Reporting';
                //check read date null
                $checkDate = Notification::query()->where(['notify_id' => $data['value']->id, 'notify_type' => 'incident'])->first();
                //update read date
                if ($request->is_notify == true && is_null($checkDate->notification_read_date_np)) {
                    $notificationData = [
                        'notification_read_date_en' => Carbon::now(),
                        'notification_read_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                        'notify_read_by' => userInfo()->id,
                    ];

                    Notification::query()->where(['notify_id' => $data['value']->id, 'notify_type' => 'incident'])->update($notificationData);

                }
                $data['filePath'] = IncidentReporting::FILE_UPLOAD_PATH;

                return view('backend.grevience.incidentReportings.show', $data);
            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return back();
            }
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
