<?php

namespace App\Http\Controllers\FrontEnd;

use App\Facades\NepaliDate;
use App\Helpers\ComplaintHelper;
use App\Helpers\DateConverter;
use App\Helpers\FileUploadLibraryHelper;
use App\Helpers\SmsHelper;
use App\Helpers\TokenHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\RegisterComplaintRequest;
use App\Http\Requests\FrontEnd\RegisterComplaintRequest1;
use App\Models\BasicDetails\ComplaintSource;
use App\Models\BasicDetails\FormCategory;
use App\Models\BasicDetails\MstCountry;
use App\Models\BasicDetails\MstOffice;
use App\Models\BasicDetails\SeverityType;
use App\Models\ComplaintProgressInfo;
use App\Models\Grevience\Complaint;
use App\Models\Grevience\Notification;
use App\Models\Grevience\SuggestionCategory;
use App\Models\Models\Grevience\ComplaintStatus;
use App\Repositories\CalendarRepository;
use App\Repositories\FrontEnd\ChartRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class GrievanceController extends Controller
{
    private ChartRepository $chartRepository;

    private CalendarRepository $calendarRepository;

    public function __construct(ChartRepository $chartRepository,
        CalendarRepository $calendarRepository)
    {
        $this->chartRepository = $chartRepository;
        $this->calendarRepository = $calendarRepository;
    }

    public function complaintView(Request $request)
    {
        try {
            $data['complaint'] = $request->session()->get('complaint');
            $data['page_title'] = getLan() == 'np' ? 'गुनासो दर्ता ' : 'Complaint Form';
            $name = getLan() == 'np' ? 'name_ne' : 'name';
            $data['severity'] = SeverityType::select('id', $name.' '.'as name_ne')->get();
            $data['category'] = FormCategory::select('id', $name.' '.'as name_ne')->whereNot('code', 3)->get();
            $data['office'] = MstOffice::select('id', $name.' '.'as name_ne')->get();
            $data['load_css'] = [
                'https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css',
            ];
            $data['load_js'] = [
                'js/complaint/frontendcomplaint.js',
                'js/fileValidation.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.js',

            ];
            $data['script_js'] = "$(function(){
                   $('#mobile').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
                   $('#mobile_first').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
                    $(document).ready(function () {
                        $('.type-select').niceSelect();
                    });
                    $(function () {
                    $('#uploadToggler').click(function () {
                        $('#imageUploadInput').click();
                    })
                    })
               })";
            $data['current_url'] = Route::current()->getName();

            return view('frontend.grievance.complaint', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function postComplaint(RegisterComplaintRequest $request)
    {
        try {

            $statusInfo = ComplaintStatus::where('code', 'NOT')->first();
            $statusId = $statusInfo->id;
            $sourceInfo = ComplaintSource::where('code', 'WEBSITE')->first();
            $sourceId = $sourceInfo->id;
            $validatedData = $request->validate([
                'form_category_id' => 'required',
                'severity_type_id' => 'required',
                'description' => 'required',
                'office_id' => 'nullable',
                'file_name' => 'nullable|mimes:jpg,png,pdf|max:2048',

            ]);
            $randomno = $this->generateUniqueNumber();

            if (empty($request->session()->get('complaint'))) {
                $randomno = $this->generateUniqueNumber();
            } else {

                $complaint = $request->session()->get('complaint');
                $randomno = $complaint->complaint_no;
            }

            if ($request->hasfile('file_name')) {
                $validatedData['file_name'] = FileUploadLibraryHelper::setFileUploadName($request->file_name, $randomno);
                $imageSuccess = true;
            }
            if (isset($imageSuccess)) {
                FileUploadLibraryHelper::setFileUploadPath($request->file_name, $validatedData['file_name'], Complaint::FILE_UPLOAD_PATH);
            }

            if (empty($request->session()->get('complaint'))) {
                $complaint = new Complaint();
                $complaint->fill($validatedData);
                $complaint->file_name = $validatedData['file_name'] ?? null;
                $complaint->complaint_no = $randomno;
                $complaint->status = $statusId;
                $complaint->complaint_source_id = $sourceId;
                $complaint->client_id = clientInfo()->id;
                $request->session()->put('complaint', $complaint);
            } else {
                $complaint = $request->session()->get('complaint');
                $complaint->fill($validatedData);
                if (@$validatedData['file_name']) {
                    $filePath = storage_path('app/public/uploads/documents/'.$complaint->complaint_no.'/'.$complaint->file_name);
                    if (is_file($filePath)) {
                        unlink($filePath);
                    }
                    $complaint->file_name = $validatedData['file_name'] ?? null;
                } else {
                    $complaint->file_name = $complaint->file_name;
                }
                $complaint->status = $statusId;
                $complaint->complaint_source_id = $sourceId;

                $complaint->complaint_no = $randomno;
                $request->session()->put('complaint', $complaint);
            }

            return redirect()->route('complaint-complainer');
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function complainerInfoView(Request $request)
    {
        try {

            $data['load_js'] = [
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
            ];
            $data['script_js'] = "$(function(){
                 $('.mobileNo').inputmask('9999999999', { placeholder: '' });
              })";
            $data['current_url'] = Route::current()->getName();

            $data['complaint'] = $request->session()->get('complaint');
            $data['page_title'] = getLan() == 'np' ? 'गुनासो दर्ता ' : 'Complaint Form';

            return view('frontend.grievance.complainer', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function postcomplainerInfoView(RegisterComplaintRequest1 $request)
    {
        try {

            $complaint = $request->session()->get('complaint');
            $validatedInfo = [
                'name_en' => $request->name_ne,
                'name_np' => $request->name_ne,
                'mobile_no' => $request->mobile_no,
                'email' => $request->email,
                'tole' => $request->tole,
                'complaint_date_en' => Carbon::now(),
                'complaint_date_np' => NepaliDate::create(Carbon::now())->toBS(),
            ];
            $validatedInfo['complaint_month_code'] = (int) explode('-', $validatedInfo['complaint_date_np'])[1];

            $complaint->fill($validatedInfo);
            $request->session()->put('complaint', $complaint);

            return redirect()->route('complaint-confirm');
        } catch (\Exception $e) {

            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function confirmView(Request $request)
    {
        try {
            $data['current_url'] = Route::current()->getName();

            $data['complaint'] = $request->session()->get('complaint');
            $data['page_title'] = getLan() == 'np' ? 'गुनासो दर्ता ' : 'Complaint Form';
            $data['load_js'] = [
                'js/main.js',
            ];

            return view('frontend.grievance.confirm', $data);
        } catch (\Exception $e) {

            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function postConfirmView(Request $request)
    {
        try {

            $smsInfo = new ComplaintHelper();
            $complaint = $request->session()->get('complaint');
            $complaint->save();
            //find complaint no

            $complaintInfo = Complaint::query()->where('complaint_no', $complaint->complaint_no)->first();
            //add notification logs
            DB::beginTransaction();
            $notificationData = [
                'fy_id' => $complaintInfo->fy_id,
                'client_id' => $complaintInfo->client_id,
                'notify_date_en' => Carbon::now(),
                'notify_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'title_en' => 'New complaint register',
                'title_np' => 'नयाँ गुनासो दर्ता',
                'notify_type' => 'complaint',
                'notify_url' => 'complaints'.'/'.hashIdGenerate($complaintInfo->id),
                'notify_id' => $complaintInfo->id,
            ];
            //add notification
            Notification::create($notificationData);
            //Token Log
            $tokenInfo = TokenHelper::storeToken('GHS', 'complaint', 'हेर्न बाँकि', 'NOT SEEN', 1, $complaint->complaint_no);
            TokenHelper::storeTokenLog($tokenInfo->token_no, 'हेर्न बाँकि', 'NOT SEEN', 1, $complaint->complaint_no);
            DB::commit();

            if (mailSetting(clientInfo()->id)) {
                Mail::send('emailTemplates.grievanceInfo', [
                    'name' => $complaint->name_ne,
                    'complaint_no' => $complaint->complaint_no,
                ], function ($message) use ($complaint) {
                    $message->from(config('mail.from.address'), 'e-office');
                    $message->to($complaint->email)->subject('गुनासो दर्ता जानकारी');
                });
            }
            if (smsSetting(clientInfo()->id)) {
                SmsHelper::sendSMS($complaint->mobile_no, 'तपाइको गुनासो सफलतापुर्बक दर्ता गरिएको छ | तपाइको टिकट नं.'.$complaint->complaint_no.' रहेको छ |');
            }
            $request->session()->forget('complaint');
            Session::flash('success', Lang::get('frontEndFlashMessage.complaint_register_message').' '
                .$complaint->complaint_no.' '.Lang::get('frontEndFlashMessage.complaint_ticket_no'));
            return response()->json([
                'status' => true,
                'appointment_message' => Lang::get('frontEndFlashMessage.suggestion_register_message'),
            ]);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function trackComplaintView(Request $request)
    {
        try {
            $data['load_css'] = [
                'css/style.css',
            ];

            return view('frontend.complaints.complaint_track', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function getComplaintStatus(Request $request)
    {
        try {
            $ticketno = $request->complaint_no;
            $chk_ticket_presence = Complaint::where('complaint_no', $ticketno)->first();
            if ($chk_ticket_presence) {
                $data['complaint'] = $complaintInfo = Complaint::where('complaint_no', $ticketno)->first();
            } else {
                Session::flash('data_not_found', Lang::get('frontEndFlashMessage.ticket_not_found'));

                return redirect()->back();
            }

            $data['complaintStatus'] = ComplaintStatus::all();
            $data['complaintsType'] = $categoryType = FormCategory::latest()->get();
            $data['country'] = MstCountry::all();
            $data['source'] = ComplaintSource::all();
            $data['severityType'] = SeverityType::all();
            $data['office'] = MstOffice::all();
            $data['dateHelper'] = new DateConverter();
            $data['complaint'] = Complaint::with(['category', 'complaintStatus', 'complaintSource', 'complaintPriority', 'office', 'addedBy'])->where('complaint_no', $ticketno)->first();
            $data['progress'] = ComplaintProgressInfo::with(['userInfo'])->where('complaint_id', $complaintInfo->id)->orderBy('id', 'DESC')->get();
            $data['load_css'] = [
                'css/trackingprogress.css',
            ];

            return view('frontend.complaints.complaintStatus', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function generateUniqueNumber()
    {
        $randomNumber = mt_rand(1000000000, 9999999999);
        $count = Complaint::where('complaint_no', $randomNumber)->count();
        if ($count > 0) {
            return $this->generateUniqueNumber();
        } else {
            return $randomNumber;
        }
    }

    public function index(Request $request)
    {

        try {

            $page_title = getLan() == 'np' ? 'गुनासो तथा सुझाव' : 'Complaint & Suggestion';

            //status wise complaint chart data start
            $name = getLan() == 'np' ? 'name_ne' : 'name';
            $complaintStatusList = ComplaintStatus::select('id', $name.' '.'as name')->whereIn('id', [1, 2])->get();
            //for status wise chart data
            $complaintJsData = '';
            $complaintJsFinalData = '';
            $complaintJsSeriesData = '';

            foreach ($complaintStatusList as $status) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->monthWiseComplaintStatusData($i, $status->id);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $complaintJsData = 'data : ['.$coma_data.']';
                $js_source_data = '{
            name: "'.$status->name.'",
            '.$complaintJsData.'
            },';
                $complaintJsFinalData .= $js_source_data;
            }
            $complaintJsSeriesData = 'series:[
            '.$complaintJsFinalData.'
            ]';
            //status wise complaint chart data end

            //complaint source wise chart data start

            $name = getLan() == 'np' ? 'name_ne' : 'name';
            $complaintSourceList = ComplaintSource::select('id', $name.' '.'as name')->get();
            $complaintSourceJsData = '';
            $complaintSourceJsFinalData = '';
            $complaintSourceJsSeriesData = '';

            foreach ($complaintSourceList as $source) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->monthWiseComplaintSourceData($i, $source->id);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $complaintSourceJsData = 'data : ['.$coma_data.']';
                $js_source_data = '{
            name: "'.$source->name.'",
            '.$complaintSourceJsData.'
            },';
                $complaintSourceJsFinalData .= $js_source_data;
            }
            $complaintSourceJsSeriesData = 'series:[
            '.$complaintSourceJsFinalData.'
            ]';
            //complaint source wise chart data end

            //categories wise suggestion chart data start
            $name = getLan() == 'np' ? 'name_ne' : 'name';
            $suggestionTypeList = SuggestionCategory::select('id', $name.' '.'as name')->get();
            $suggestionTypeJsData = '';
            $suggestionTypeFinalJsFinalData = '';
            $suggestionTypeJsSeriesData = '';

            foreach ($suggestionTypeList as $type) {
                $data = [];
                for ($i = 1; $i <= 12; $i++) {
                    $res_total = $this->chartRepository->monthWiseSuggestionTypeData($i, $type->id);
                    $data[] = $res_total[0]->totals ?? 0;

                }
                $coma_data = implode(', ', $data);
                $suggestionTypeJsData = 'data : ['.$coma_data.']';
                $js_source_data = '{
            name: "'.$type->name.'",
            '.$suggestionTypeJsData.'
            },';
                $suggestionTypeFinalJsFinalData .= $js_source_data;
            }
            $suggestionTypeJsSeriesData = 'series:[
            '.$suggestionTypeFinalJsFinalData.'
            ]';

            //categories wise suggestion chart data end

            //incident  month wise  chart data start
            $incidentJsData = '';
            $incidentFinalJsFinalData = '';
            $incidentJsSeriesData = '';

            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $res_total = $this->chartRepository->monthWiseIncidentData($i);
                $data[] = $res_total[0]->totals ?? 0;

            }
            $coma_data = implode(', ', $data);
            $incidentJsData = 'data : ['.$coma_data.']';
            $js_source_data = '{
            name: "'.'Incident'.'",
            '.$incidentJsData.'
            },';
            $incidentFinalJsFinalData .= $js_source_data;
            $incidentJsSeriesData = 'series:[
            '.$incidentFinalJsFinalData.'
            ]';

            //incident  month wise  chart data end
            //office automation module  appointment month wise chart  data end
            $monthNames = getLan() == 'np' ? $this->calendarRepository->nepaliMonthNames() : $this->calendarRepository->englishMonthNames();

            return view('frontend.innerPage.grievanceInfo', compact(
                'page_title', 'complaintJsSeriesData', 'complaintSourceJsSeriesData',
                'suggestionTypeJsSeriesData', 'incidentJsSeriesData', 'monthNames'
            ));
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public static function checkComplaintTokenStatus($tokenInfo)
    {
        try {
            $data['complaint'] = $tokenInfo;

            $data['complaintStatus'] = ComplaintStatus::all();
            $data['complaintsType'] = $categoryType = FormCategory::latest()->get();
            $data['country'] = MstCountry::all();
            $data['source'] = ComplaintSource::all();
            $data['severityType'] = SeverityType::all();
            $data['office'] = MstOffice::all();
            $data['dateHelper'] = new DateConverter();
            $data['complaint'] = Complaint::with(['category', 'complaintStatus', 'complaintSource', 'complaintPriority', 'office', 'addedBy'])->where('complaint_no', $data['complaint']->complaint_no)->first();
            $data['progress'] = ComplaintProgressInfo::with(['userInfo'])->where('complaint_id',  $data['complaint']->id)->orderBy('id', 'DESC')->get();
            $data['load_css'] = [
                'css/trackingprogress.css',
            ];

            return view('frontend.complaints.complaintStatus', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

}
