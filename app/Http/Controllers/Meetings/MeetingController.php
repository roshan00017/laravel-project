<?php

namespace App\Http\Controllers\Meetings;

use App\Events\AgendaFinalizedEvent;
use App\Events\NotifyAgendaFinalizedEvent;
use App\Facades\NepaliDate;
use App\Helpers\ApiAuthenticationHelper;
use App\Helpers\DateConverter;
use App\Helpers\SmsHelper;
use App\Helpers\TokenHelper;
use App\Helpers\VoiceCallManagementHelper;
use App\Http\Controllers\BaseController;
use App\Models\Meetings\KaryapalikaMember;
use App\Models\Meetings\Meeting;
use App\Models\Meetings\MeetingAgendaList;
use App\Models\Meetings\MeetingMember;
use App\Models\Meetings\MeetingStatusLog;
use App\Models\Meetings\MstMeetingCategory;
use App\Models\Meetings\MstMeetingStatus;
use App\Models\TokenManagement\Token;
use App\Models\TokenManagement\TokenLog;
use App\Models\VoiceCallManagement\AudioFile;
use App\Models\VoiceCallManagement\PhoneSmsCampaignNumber;
use App\Repositories\CommonRepository;
use App\Repositories\LogsRepository;
use App\Repositories\MMS\MeetingRepository;
use App\Repositories\VoiceCallManagementRepository;
use Carbon\Carbon;
use Exception;
use Harmoniemedia\SimpleLaravelJitsi\SimpleLaravelJitsi;
use Hashids\Hashids;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Spatie\GoogleCalendar\Event;

class MeetingController extends BaseController
{
    protected Meeting $model;

    protected CommonRepository $common;

    protected LogsRepository $logsRepository;

    protected MeetingRepository $meetingRepository;

    protected DateConverter $dateConverter;

    protected VoiceCallManagementRepository $voiceCallManagementRepository;

    private int $menuId = 6;

    public function __construct(
        Meeting $model, LogsRepository $logsRepository,
        MeetingRepository $meetingRepository, DateConverter $dateConverter, VoiceCallManagementRepository $voiceCallManagementRepository
    ) {
        parent::__construct();
        $this->model = $model;
        $this->common = new CommonRepository($model);
        $this->logsRepository = $logsRepository;
        $this->meetingRepository = $meetingRepository;
        $this->dateConverter = $dateConverter;
        $this->voiceCallManagementRepository = $voiceCallManagementRepository;
    }

    public function index(Request $request)
    {
        try {
            $data['page_url'] = '/meetings';
            $data['page_route'] = 'meetings';
            $data['show_button'] = true;

            $data['page_title'] = getLan() == 'np' ? 'बैठक व्यवस्थापन' : 'Meeting Management';
            $data['request'] = $request;
            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

            ];
            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_search.js',
                'js/custom_app.min.js',
                'js/dateConverter.js',
                'js/meetingStatusUpdate.js',
                'js/voiceCallManagement/phoneSms.js',

            ];

            if (Session::has('addMore')) {
                $data['script_js'] = "$(function(){
                     $(document).ready(function() {
                        $('#addModal').modal('show');
                    });
                

             })";
            }
            $data['results'] = $this->meetingRepository->getAllMeetings($request);

            $data['meetingRepo'] = $this->meetingRepository;
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['meetingStatusList'] = MstMeetingStatus::select('id', $name.' '.'as name');
            $data['meetingUpdateStatusList'] = MstMeetingStatus::whereNotIn('id', [1, 5])->select('id', $name.' '.'as name');
            $data['agendaFinal'] = MeetingAgendaList::all();
            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['meetingCategoryList'] = MstMeetingCategory::select('id', $name.' '.'as name');

            return view('backend.meetingManagement.meeting.index', $data);
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

    public function show($id)
    {

        try {

            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['page_url'] = '/meetingMembers';
                $data['page_route'] = 'meetingMembers';
                $data['value'] = Meeting::query()->find($hashIdValue[0]);
                // Assuming you have a User model and a users table in your database
                $data['memberList'] = Meeting::query()->where('meeting_status_id', $data['value']->id)->get();
                $name = getLan() == 'np' ? 'name_np' : 'name_en';
                $data['karyapalikamember'] = KaryapalikaMember::select('id', $name.' '.'as name')->get();
                $data['meetingList'] = Meeting::query()->where('meeting_status_id', 1)->orderBy('id', 'desc')->get();
                $data['meetingCodeList'] = Meeting::query()->orderBy('id', 'desc')->get();
                $data['meetingListCode'] = Meeting::query()->where('meeting_category_id', 2)->get();
                $data['cancel_button'] = true;
                $data['page_title'] = getLan() == 'np' ? 'बैठक सदस्य' : 'Meeting Member';
                $data['load_css'] = [
                    'plugins/select2/css/select2.css',

                ];
                $data['load_js'] = [
                    'plugins/select2/js/select2.full.min.js',
                    'js/selector.min.js',
                    'js/meeting.js',
                    'js/meeting_member.js',

                ];
                $data['script_js'] = "$(function(){
                    $('#mobile').inputmask('9999999999', { 'placeholder': '98xxxxxxxx' })
                
                })";
                $data['index_page_url'] = '/meetings';

                if ($data) {

                    $data['page_title'] = getLan() == 'np' ? 'बैठक सदस्य' : 'Meeting Member';
                    $data['page_url'] = 'meetings';

                    return view('backend.meetingManagement.meeting.memberDetails.show', $data);
                }

            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('meetings');
            }

        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }

    }

    public function create(Request $request)
    {
        try {

            if ($request->date_en != null) {
                $year = explode('-', $request->date_en)[0];
                $month = explode('-', $request->date_en)[1];
                $day = explode('-', $request->date_en)[2];

                $request['date_en'] = $this->dateConverter->nep_to_eng($year, $month, $day);
            }

            $data['page_title'] = getLan() == 'np' ? 'बैठक व्यवस्थापन' : 'Meeting Management';
            $data['page_url'] = '/meetings';
            $data['page_route'] = 'meetings';
            $data['request'] = $request;

            $data['load_css'] = [
                'plugins/select2/css/select2.css',
                'plugins/datepicker/english/english-datepicker.css',
                'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

            ];

            $data['load_js'] = [
                'plugins/select2/js/select2.full.min.js',
                'plugins/input-mask/jquery/inputmask.min.js',
                'plugins/input-mask/jquery/date_extension.min.js',
                'plugins/input-mask/jquery/extension.min.js',
                'plugins/select2/js/select2.full.min.js',
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_app.min.js',
                'js/dateConverter.js',
                'js/meeting.js',

            ];
            $data['cancel_button'] = true;
            $data['add_more_button'] = true;
            $data['index_page_url'] = '/meetings';

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['meetingStatusList'] = MstMeetingStatus::select('id', $name.' '.'as name');

            $name = getLan() == 'np' ? 'name_np' : 'name_en';
            $data['meetingCategoryList'] = MstMeetingCategory::select('id', $name.' '.'as name');

            return view('backend.meetingManagement.meeting.create', $data);
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->all();
            //check client id null

            $data['client_id'] = setClientId($request);
            $data['fy_id'] = currentFy()->id;

            //set meeting code
            $data['code'] = setMeetingCode($request->client_id);
            $data['created_by'] = userInfo()->id;
            //set first status pending
            $data['meeting_status_id'] = 1;
            //check notify
            if ($request->is_notify == 1) {
                $data['notify_date_ad'] = Carbon::now()->toDateString();
                $data['notify_date_bs'] = NepaliDate::create(Carbon::now())->toBS();
            }
            $data['meeting_month_code'] = (int) explode('-', $request->meeting_date_bs)[1];

            DB::beginTransaction();

            $create = $this->common->create($data);
            if ($create) {
                // insert log
                $this->logsRepository->insertLog($create->id, $this->menuId, 1);
                $agendaDataArray = $data['addMeetingAgendas'];
                $memberDataArray = $data['addMeetingMembers'];
                //add meeting agenda data
                if ($agendaDataArray[0]['agenda_title'] != null) {
                    foreach ($agendaDataArray as $key => $agenda) {
                        $agendaDetails = [
                            'meeting_id' => $create->id,
                            'title' => $agenda['agenda_title'],
                            'description' => $agenda['description'],
                            'created_by' => userInfo()->id,

                        ];
                        MeetingAgendaList::query()->create($agendaDetails);
                    }
                }
                //add karrya palika member details
                if ($request->meeting_category_id == 2) {
                    $karyapalikaMembers = KaryapalikaMember::query()->where('client_id', clientInfo()->id)->get();

                    foreach ($karyapalikaMembers as $karyapalikaMember) {
                        $karyapalikamembers = [
                            'client_id' => $karyapalikaMember->client_id,
                            'name_np' => $karyapalikaMember->name_np,
                            'name_en' => $karyapalikaMember->name_en,
                            'email' => $karyapalikaMember->email,
                            'office' => '',
                            'post' => $karyapalikaMember->designation,
                            'created_by' => userInfo()->id,
                            'meeting_id' => $create->id,
                            'contact_no' => $karyapalikaMember->mobile,
                            'karyapalika_member_id' => $karyapalikaMember->id,

                        ];
                        DB::beginTransaction();
                        MeetingMember::query()->create($karyapalikamembers);
                        DB::commit();

                    }
                }
                if ($memberDataArray[0]['name_en'] != null) {
                    //add meeting member data
                    foreach ($memberDataArray as $key => $member) {
                        $memberDetails = [
                            'meeting_id' => $create->id,
                            'name_en' => $member['name_en'],
                            'name_np' => $member['name_np'],
                            'office' => $member['office'],
                            'post' => $member['post'],
                            'contact_no' => $member['contact_no'],
                            'email' => $member['email'],
                            'is_invite' => $member['is_invite'] ?? false,
                            'created_by' => userInfo()->id,

                        ];
                        MeetingMember::query()->create($memberDetails);
                    }
                }
                //aad meeting status logs
                $logs = [
                    'meeting_id' => $create->id,
                    'meeting_status_id' => 1,
                    'updated_by' => userInfo()->id,
                    'updated_date_en' => Carbon::now(),
                    'updated_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                    'remarks' => $request->remarks,
                ];
                MeetingStatusLog::create($logs);

                if ($request->is_notify == 1) {
                    $getMemberList = $this->meetingRepository->getMeetingMemberList($logs['meeting_id']);
                    $getAgendaList = $this->meetingRepository->getAgendaListByMeeting($logs['meeting_id']);
                    if ($request->meetingMode == 'online') {
                        $message = 'Meeting Code :'.$create->code.' Agenda Successfully Finalized'.' '.$request->meeting_url;
                    } else {
                        $message = 'Meeting Code :'.$create->code.' Agenda Successfully Finalized';
                    }
                    foreach ($getMemberList as $member) {
                        if (smsSetting(userInfo()->client_id)) {
                            SmsHelper::sendSms($member->contact_no, $message);
                        }
                        $memberName = getLan() == 'np' ? $member->name_np : $member->name_en;
                        $mailData = [
                            'memberName' => $memberName,
                            'agendaList' => $getAgendaList,
                            'meetingInfo' => $data,
                            'memberInfo' => $member,
                            'email' => $member->email,
                        ];
                        if (mailSetting(userInfo()->client_id)) {
                            NotifyAgendaFinalizedEvent::dispatch($mailData);

                        }

                    }
                }

                //add smart token
                $tokenInfo = TokenHelper::storeToken('mms', 'meeting', 'सुरु  हुन बाकी', 'Pending', 1, $create->id);
                TokenHelper::storeTokenLog($tokenInfo->token_no, 'सुरु  हुन बाकी', 'Pending', 1, $create->id);

                // //google Calendar
                // // Assuming you have stored the meeting details in variables
                // $meetingTitle = $request->title;
                // $meetingDate = Carbon::parse($request->meeting_date_ad);
                // $meetingTime = Carbon::createFromFormat('H:i', $request->meeting_time);

                // $meetingDateTime = $meetingDate->setTimeFromTimeString($meetingTime->format('H:i'));

                // // Create a new event instance
                // $event = new Event;

                // // Set the event details
                // $event->name = $meetingTitle;
                // $event->startDateTime = $meetingDateTime;
                // $event->endDateTime = $meetingDateTime->copy()->addHour();

                // // Save the event to Google Calendar
                // $event->save();

                session()->flash('success', Lang::get('message.flash_messages.insertMessage'));
                DB::commit();
            }
            if ($request->addMore == 'true') {
                return back();
            }

            return redirect(url('meetings'));
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $check = Meeting::query()->find($id);
            DB::beginTransaction();
            $data = $request->all();
            if ($data['meeting_mode'] == 'offline') {
                $data['meeting_url'] = '';
            }
            if ($data['meeting_password_available'] == 0) {
                $data['meeting_password'] = '';
            }
            //check notify
            if ($request->is_notify == 1) {
                $data['notify_date_ad'] = Carbon::now()->toDateString();
                $data['notify_date_bs'] = NepaliDate::create(Carbon::now())->toBS();
            }
            $data['meeting_month_code'] = (int) explode('-', $request->meeting_date_bs)[1];
            $this->common->update($data, $id);

            // insert log
            $this->logsRepository->insertLog($check->id, $this->menuId, 2);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return redirect(url('meetings'));
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return redirect(url('meetings'));
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = Meeting::query()->find($hashIdValue[0]);
                $data['agendaList'] = $this->meetingRepository->getAgendaListByMeeting($data['value']->id);
                $data['memberList'] = $this->meetingRepository->getMeetingMemberByMeeting($data['value']->id);

                $data['page_title'] = getLan() == 'np' ? 'बैठक व्यवस्थापन' : 'Meeting Management';
                $data['page_url'] = '/meetings';
                $data['page_route'] = 'meetings';
                $data['request'] = $request;

                $data['load_css'] = [
                    'plugins/select2/css/select2.css',
                    'plugins/datepicker/english/english-datepicker.css',
                    'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

                ];

                $data['load_js'] = [
                    'plugins/select2/js/select2.full.min.js',
                    'plugins/input-mask/jquery/inputmask.min.js',
                    'plugins/input-mask/jquery/date_extension.min.js',
                    'plugins/input-mask/jquery/extension.min.js',
                    'plugins/select2/js/select2.full.min.js',
                    'plugins/datepicker/english/english-datepicker.min.js',
                    'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                    'js/custom_search.js',
                    'js/custom_app.js',
                    'js/dateConverter.js',
                    'js/meeting.js',

                ];
                $data['cancel_button'] = true;
                $data['index_page_url'] = '/meetings';

                $name = getLan() == 'np' ? 'name_np' : 'name_en';
                $data['meetingStatusList'] = MstMeetingStatus::select('id', $name.' '.'as name');

                $name = getLan() == 'np' ? 'name_np' : 'name_en';
                $data['meetingCategoryList'] = MstMeetingCategory::select('id', $name.' '.'as name');
                $data['agendaUrl'] = 'meetingAgendaList';
                $data['membersUrl'] = 'meetingMembers';

                return view('backend.meetingManagement.meeting.update', $data);

            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('meetings');
            }
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commonges.technicalError'));

            return back();
        }

    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            $value = $this->common->find($id);
            if ($value) {
                DB::beginTransaction();
                //delete child table data
                MeetingAgendaList::query()->where('meeting_id', $value->id)->delete();
                MeetingMember::query()->where('meeting_id', $value->id)->delete();
                MeetingStatusLog::query()->where('meeting_id', $value->id)->delete();
                $data['deleted_by'] = auth()->user()->id;
                $this->common->update($data, $id);
                $this->common->delete($id);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 4);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.deleteMessage'));
            } else {
                session()->flash('warning', Lang::get('message.flash_messages.warningMessage'));
            }

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function status($id): RedirectResponse
    {
        try {
            $id = (int) $id;
            $value = $this->model->find($id);
            if ($value->meeting_status_id == 0) {
                DB::beginTransaction();
                $this->common->status($value->id, 1);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 5);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
            } elseif ($value->meeting_status_id == 1) {
                DB::beginTransaction();
                $this->common->status($value->id, 0);
                // insert log
                $this->logsRepository->insertLog($value->id, $this->menuId, 6);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusInactiveMessage'));
            }

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function agendaStatusUpdate($id, Request $request)
    {
        try {
            $id = (int) $id;
            $value = $this->model->find($id);

            if ($value->agenda_finalized == 0) {
                // DB::beginTransaction();
                //                $this->model->where('id', $id)->update([
                //                    'agenda_finalized' => 1,
                //                    'agenda_finalized_date_bs' => NepaliDate::create(Carbon::now())->toBS(),
                //                    'agenda_finalized_date_ad' => Carbon::now()->toDateString(),
                //                ]);
                if ($value->meetingMode == 'online') {
                    $message = 'Meeting Code :'.$value->code.' Agenda Successfully Finalized'.' '.$value->meeting_url;
                } else {
                    $message = 'Meeting Code :'.$value->code.' Agenda Successfully Finalized';
                }
                $getMemberList = $this->meetingRepository->getMeetingMemberList($value->id);
                $getAgendaList = $this->meetingRepository->getAgendaListByMeeting($value->id);
                foreach ($getMemberList as $member) {
                    if ($request->send_sms == 1) {
                        if (smsSetting(userInfo()->client_id)) {
                            SmsHelper::sendSms($member->contact_no, $message);
                        }
                    }
                    $memberName = getLan() == 'np' ? $member->name_np : $member->name_en;
                    $mailData = [
                        'memberName' => $memberName,
                        'agendaList' => $getAgendaList,
                        'meetingInfo' => $value,
                        'memberInfo' => $member,
                        'email' => $member->email,
                    ];
                    if ($request->send_email == 1) {
                        if (mailSetting(userInfo()->client_id)) {
                            AgendaFinalizedEvent::dispatch($mailData);

                        }
                    }

                }

                $getAgendaList = $this->meetingRepository->getAgendaList($value->id);
                if ($request->convert_voice == 1) {

                    foreach ($getAgendaList as $agenda) {

                        //call voice api
                        $result = ApiAuthenticationHelper::authApi('riri', $agenda->title);

                        //add audio file
                        //VoiceCallManagementHelper::storeAudioFile('mms', $value->code, $result['result_audio']);
                        //add audio files
                        $data = [
                            'fy_id' => currentFy()->id,
                            'client_id' => userInfo()->client_id,
                            'module_name' => 'mms',
                            'module_unique_id' => $value->code,
                            'created_by' => userInfo()->id,
                            'audio_file' => $result['result_audio'],
                            'generate_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                            'generate_date_en' => Carbon::now()->toDateString(),
                        ];
                        AudioFile::create($data);
                    }
                }
                //call call / sms api
                if ($request->create_campaign == 1) {
                    $memberCollection = $this->meetingRepository->getMeetingMemberContactNoList($value->id);
                    $numbers = $memberCollection->toArray();
                    $numbers = array_map('intval', $numbers);
                    $data = [
                        'name' => $value->title,
                        'services' => $request->services,
                        'description' => $value->description,
                        'individual_number' => $numbers,
                    ];

                    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
                    $callSms = $this->voiceCallManagementRepository->addCampaign($jsonData);
                    if (is_null($callSms)) {
                        Session::flash('server_error', Lang::get('message.commons.technicalError'));

                        return back();
                    }
                    //store new data in campaign table
                    $campaignData = [
                        'module_name' => 'mms',
                        'module_unique_id' => $value->code,
                        'campaign_name' => $callSms['data']['details']['name'],
                        'campaign_detail' => $callSms['data']['details']['description'],
                        'campaign_number_count' => $callSms['data']['details']['number_count'],
                        'campaign_service' => $callSms['data']['details']['services'],
                        'campaign_status' => $callSms['data']['details']['status'],
                        'campaign_api_id' => $callSms['data']['details']['id'],
                    ];
                    $create = $this->voiceCallManagementRepository->storeNewCampaign($campaignData);
                    //update campaign id in meeting table
                    Meeting::query()->where('id', $value->id)->update(['campaign_id' => $create->id, 'is_campaign_create' => true]);

                    //add campaign number
                    $numberList = $this->voiceCallManagementRepository->numberListPhoneSmsService($create->campaign_api_id, 'api');
                    foreach ($numberList['data']['number-lists'] as $key => $number) {
                        $campaignNumberData = [
                            'fy_id' => currentFy()->id,
                            'client_id' => clientInfo()->id,
                            'campaign_id' => $create->id,
                            'campaign_api_id' => $callSms['data']['details']['id'],
                            'api_number_id' => $number['id'],
                            'number' => $number['number'],
                            'status' => $number['status'],
                            'created_by' => userInfo()->id,
                        ];
                        PhoneSmsCampaignNumber::create($campaignNumberData);

                    }

                }
                //update campaign id
                DB::commit();

            //session()->flash('success', Lang::get('message.flash_messages.statusActiveMessage'));
            } elseif ($value->agenda_finalized == 1) {
                DB::beginTransaction();
                $this->model->where('id', $id)->update(['agenda_finalized' => 0]);
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.statusInactiveMessage'));
            }
            session()->flash('success', Lang::get('message.flash_messages.updateMessage'));

            return response()->json([
                'status' => true,
                'success' => Lang::get('message.flash_messages.updateMessage'),
            ]);
            //return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function meetingStatusUpdate($id, Request $request): RedirectResponse
    {
        try {

            $id = (int) $id;
            $value = $this->model->find($id);
            if ($value) {
                DB::beginTransaction();
                $this->model->where('id', $id)->update(['meeting_status_id' => $request->meeting_status_id]);
                //update meeting     date
                if ($request->meeting_status_id == 3 || $request->meeting_status_id == 4) {
                    $dateValue = [
                        'date_bs' => $request->status_date_bs,
                        'date_ad' => $request->status_date_ad,
                        'updated_by' => userInfo()->id,
                    ];
                    $this->common->update($dateValue, $id);
                }
                //aad meeting status logs
                $logs = [
                    'meeting_id' => $value->id,
                    'meeting_status_id' => $request->meeting_status_id,
                    'updated_by' => userInfo()->id,
                    'updated_date_en' => Carbon::now(),
                    'updated_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                    'remarks' => $request->remarks,
                ];
                MeetingStatusLog::create($logs);

                if ($request->meeting_status_id == 2) {
                    $status_update = [
                        'status_title_en' => 'Cancelled',
                        'status_title_np' => 'रद्द गरिएको ',
                    ];
                } elseif ($request->meeting_status_id == 3) {
                    $status_update = [
                        'status_title_en' => 'Postponed',
                        'status_title_np' => 'स्थगित गरिएको',
                    ];
                } elseif ($request->meeting_status_id == 4) {
                    $status_update = [
                        'status_title_en' => 'Preponed',
                        'status_title_np' => 'अघि सरेको',
                    ];
                }

                $meeting = Meeting::find($value->id);

                $tokenNo = $meeting->token->token_no;
                $module_status_id = $meeting->token->module_status_id;
                $serviceLogs = [
                    'token_no' => $tokenNo,
                    'module_status_id' => $module_status_id,
                    'date_np' => NepaliDate::create(Carbon::now())->toBS(),
                    'date_en' => Carbon::now()->toDateString(),
                ];
                $mergedValue = array_merge($status_update, $serviceLogs);
                TokenLog::create($mergedValue);

                $token = Token::where('module_unique_id', $value->id)->first();
                $token->fill($status_update);
                $token->save();
                DB::commit();
                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
            }

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function generateMetingUrl()
    {
        try {
            if (userInfo()->client_id != null) {
                $clientInfo = clientInfo(userInfo()->client_id);

                $roomName = $clientInfo->code.rand_string(10);
            } else {
                $roomName = 'soms'.rand_string(10);
            }
            $meeting_room_url = (new SimpleLaravelJitsi())->create_meeting_room_url($roomName);

            return response()->json([
                'status' => true,
                'data' => $meeting_room_url,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function addMeetingMembers(Request $request)
    {
        try {
            $data = $request->all();

            DB::beginTransaction();
            //add multiple agenda from meeting
            $meetingDataArray = $data['addMeetingMembers'];
            foreach ($meetingDataArray as $key => $member) {
                $memberDetails = [
                    'meeting_id' => $request->meeting_id,
                    'name_en' => $member['name_en'],
                    'name_np' => $member['name_np'],
                    'office' => $member['office'],
                    'post' => $member['post'],
                    'contact_no' => $member['contact_no'],
                    'email' => $member['email'],
                    'is_invite' => $member['is_invite'] ?? false,
                    'created_by' => userInfo()->id,

                ];
                $create = MeetingMember::query()->create($memberDetails);
            }
            $this->logsRepository->insertLog($create->id, $this->menuId, 1);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function addAgendaByMeeting($id)
    {
        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = Meeting::query()->find($hashIdValue[0]);
                $data['agendaList'] = $this->meetingRepository->getAgendaListByMeeting($data['value']->id);

                $data['page_title'] = getLan() == 'np' ? ' बैठक  एजेन्डा सूची' : 'Meeting Agenda List';

                $data['load_js'] = [
                    'js/agenda.js',

                ];

                $data['script_js'] = "$(function(){
                    $('#contact_no').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
                     $('#to_office_contact').inputmask('9999999999', { placeholder: '98xxxxxxxx' });
                })";

                $data['cancel_button'] = true;
                $data['page_url'] = '/meetings';
                $data['page_route'] = '/meetings';
                $data['agendaUrl'] = 'meetingAgendaList';

                return view('backend.meetingManagement.meeting.agendaListByMeeting', $data);

            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('meetings');
            }
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commonges.technicalError'));

            return back();
        }
    }

    public function agendaDetailsByMeeting(Request $request, $id)
    {
        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = Meeting::query()->find($hashIdValue[0]);
                $data['agendaList'] = $this->meetingRepository->getAgendaListByMeeting($data['value']->id);

                $data['page_title'] = getLan() == 'np' ? 'बैठक व्यवस्थापन' : 'Meeting Management';
                $data['page_url'] = '/meetings';
                $data['page_route'] = 'meetings';
                $data['request'] = $request;
                $data['cancel_button'] = true;
                $data['index_page_url'] = '/meetings';
                $data['agendaUrl'] = 'meetingAgendaList';
                $data['load_js'] = [
                    'js/custom_app.min.js',
                    'js/meeting.js',
                ];

                return view('backend.meetingManagement.meeting.agendaFinalizedDetails.index', $data);

            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('meetings');
            }
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commonges.technicalError'));

            return back();
        }

    }

    public function memberDetailsByMeeting(Request $request, $id)
    {
        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = Meeting::query()->find($hashIdValue[0]);
                $data['memberList'] = $this->meetingRepository->getMeetingMemberByMeeting($data['value']->id);

                $data['page_title'] = getLan() == 'np' ? 'बैठक व्यवस्थापन' : 'Meeting Management';
                $data['page_url'] = '/meetings';
                $data['page_route'] = 'meetings';
                $data['request'] = $request;
                $data['cancel_button'] = true;
                $data['index_page_url'] = '/meetings';
                $data['membersUrl'] = 'meetingMembers';
                $data['load_js'] = [
                    'js/custom_app.min.js',
                    'js/meeting.js',
                    'js/meeting_member.js',
                ];

                return view('backend.meetingManagement.meeting.memberDetails.showDetails', $data);

            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('meetings');
            }
        } catch (\Exception $e) {
            dd($e);
            Session::flash('server_error', Lang::get('message.commonges.technicalError'));

            return back();
        }

    }
    public function meetingAgendaDetails(Request $request, $id)
    {
        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {
                $data['value'] = Meeting::query()->find($hashIdValue[0]);
                $data['agendaList'] = $this->meetingRepository->getAgendaListByMeeting($data['value']->id);

                $data['page_title'] = getLan() == 'np' ? 'बैठक व्यवस्थापन' : 'Meeting Management';
                $data['page_url'] = '/meetings';
                $data['page_route'] = 'meetings';
                $data['request'] = $request;
                $data['cancel_button'] = true;
                $data['index_page_url'] = '/meetings';
                $data['agendaUrl'] = 'meetingAgendaList';
                $data['script_js'] = "$(function(){
                  $('.agendaUpdate').on('submit', function (e) {
                        e.preventDefault();
                        $('#dataSubmitModal').modal('show');
                        $.ajax({
                            type: 'POST',
                            headers: { 'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content') },
                            data: new FormData(this),
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            url: $(this).attr('action'),
                            success: (response) => {
                                            if (response) {
                                                window.location.href = '/meetings';
                                                toastr.success(response.message);
                                            }
                                        },
                            error: function (response) {
                                            window.location.href = '/meetings';
                                            toastr.error(response.message);
                                        },
                          });
                        });
                        $('.phoneSmsService').on('change', function () {

                        const val = $('input[name=create_campaign]:checked').val();
                        if(val ==1)
                        {
                            $('.serviceList').show();
                            $('.service').prop('required',true);
                        }else{
                            $('.serviceList').hide();
                            $('.service').prop('required',false);
                        }
                        });
                })";
                $data['load_js'] = [
                    'js/custom_app.min.js',
                ];

                return view('backend.meetingManagement.meeting.agendaFinalizedDetails.details', $data);

            } else {
                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('meetings');
            }
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commonges.technicalError'));

            return back();
        }

    }
}