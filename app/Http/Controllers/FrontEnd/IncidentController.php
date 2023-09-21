<?php

namespace App\Http\Controllers\FrontEnd;

use App\Facades\NepaliDate;
use App\Helpers\FileUploadLibraryHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\IncidentRequest;
use App\Models\Grevience\IncidentReporting;
use App\Models\Grevience\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Spatie\Geocoder\Facades\Geocoder;

class IncidentController extends Controller
{
    public function index()
    {
    }

    public function recordIncident(Request $request)
    {
        $data['load_js'] = [
            'js/incident/incident.js',
            'js/fileValidation.js',
            'plugins/input-mask/jquery/inputmask.min.js',
            'plugins/input-mask/jquery/date_extension.min.js',
            'plugins/input-mask/jquery/extension.min.js',

        ];
        $data['script_js'] = "
            $(function(){
            $('#mobile').inputmask('9999999999', { placeholder: '' });
            })
            $(function () {
                $('#uploadToggler').click(function () {
                    $('#imageUploadInput').click();
                })
                })";

        $data['filePath'] = IncidentReporting::FILE_UPLOAD_PATH;

        return view('frontend.grievance.incidents.create', $data);
    }

    public function store(IncidentRequest $request)
    {
        try {

            $data = $request->all();
            $address = Geocoder::getAddressForCoordinates($request->latitude, $request->longitude);

            if ($request->hasfile('file')) {
                $data['file'] = FileUploadLibraryHelper::setFileUploadName($request->file, $request->name);
                $fileUpload = true;
            }

            $data['address'] = $address['formatted_address'];
            $data['latitude'] = $request->latitude;
            $data['longitude'] = $request->longitude;
            $data['incident_submit_date_np'] = NepaliDate::create(Carbon::now())->toBS();
            $data['incident_submit_date_en'] = Carbon::now()->toDateString();
            $data['incident_month_code'] = (int) explode('-', $data['incident_submit_date_np'])[1];
            $data['fy_id'] = currentFy()->id;
            $data['client_id'] = clientInfo()->id;
            DB::beginTransaction();
            $create = IncidentReporting::create($data);

            //add notification logs

            $notificationData = [
                'fy_id' => $create->fy_id,
                'client_id' => $create->client_id,
                'notify_date_np' => $create->incident_submit_date_np,
                'notify_date_en' => $create->incident_submit_date_en,
                'title_en' => 'New Incident register',
                'title_np' => 'नयाँ घटना दर्ता',
                'notify_url' => 'incidentReporting'.'/'.hashIdGenerate($create->id),
                'notify_type' => 'incident',
                'notify_id' => $create->id,
            ];
            //add notification

            Notification::create($notificationData);
            if (isset($fileUpload)) {
                FileUploadLibraryHelper::setFileUploadPath($request->file, $data['file'], IncidentReporting::FILE_UPLOAD_PATH);
            }
            DB::commit();

            Session::flash('success', Lang::get('frontEndFlashMessage.incident_register_message'));

            return redirect()->route('frontEnd.dashboard');
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function getRealIpAddr()
    {
        if (! empty($_SERVER['HTTP_CLIENT_IP'])) {   // check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   // to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}
