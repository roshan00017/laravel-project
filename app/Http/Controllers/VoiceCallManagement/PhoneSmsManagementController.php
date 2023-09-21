<?php

namespace App\Http\Controllers\VoiceCallManagement;

use App\Facades\NepaliDate;
use App\Http\Controllers\BaseController;
use App\Models\VoiceCallManagement\PhoneSmsCampaign;
use App\Models\VoiceCallManagement\PhoneSmsCampaignNumber;
use App\Models\VoiceCallManagement\PhoneSmsCampaignNumberLog;
use App\Repositories\CommonRepository;
use App\Repositories\VoiceCallManagementRepository;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PhoneSmsManagementController extends BaseController
{
    private VoiceCallManagementRepository $voiceCallRepository;

    protected CommonRepository $model;

    public function __construct(VoiceCallManagementRepository $voiceCallRepository, PhoneSmsCampaign $phoneSmsCampaign)
    {
        parent::__construct();
        $this->voiceCallRepository = $voiceCallRepository;
        $this->model = new CommonRepository($phoneSmsCampaign);
    }

    public function index(Request $request)
    {

        try {
            $data['page_url'] = '/phoneSmsManagement';
            $data['page_route'] = 'phoneSmsManagement';
            $data['results'] = $this->voiceCallRepository->getAllCampaigns($request);
            $data['page_title'] = getLan() == 'np' ? 'Phone/SMS  व्यवस्थापन' : 'Phone/SMS management';
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
                'plugins/datepicker/english/english-datepicker.min.js',
                'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                'js/custom_search.js',
                'js/custom_app.min.js',
                'js/voiceCallManagement/phoneSms.js',

            ];

            return view('backend.voiceCallManagement.phoneSms.campaign.index', $data);
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function store(Request $request)
    {
        try {

            DB::beginTransaction();
            if ($request->send_to_number_file != null) {
                $extension = $request->send_to_number_file->getClientOriginalExtension();
                $fileName = date('Y-m-d-H-i-s').'-'.clientInfo()->id.'.'.$extension;
                $filePath = 'public/files/'.clientInfo()->id.'/file';
                $file = Storage::putFileAs($filePath, $request->send_to_number_file, $fileName);
            }
            $this->voiceCallRepository->addPhoneSmsService($request, $file = null);
            DB::commit();
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return response()->json([
                'status' => true,
                'success' => Lang::get('message.flash_messages.insertMessage'),
            ]);
            // return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function update(Request $request, int $campaign_api_id)
    {
        try {
            $update = $this->voiceCallRepository->updatePhoneSmsService($request, $campaign_api_id);
            if ($update) {
                $value = PhoneSmsCampaign::query()->where('campaign_api_id', $campaign_api_id)->first();
                if ($value) {
                    $data = $request->all();
                    $data['updated_by'] = userInfo()->id;
                    DB::beginTransaction();
                    $this->model->update($data, $value->id);
                    DB::commit();
                    session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
                }
            }

            return response()->json([
                'status' => true,
                'success' => Lang::get('message.flash_messages.updateMessage'),
            ]);

            // return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function destroy(Request $request, $campaign_api_id)
    {
        try {
            $delete = $this->voiceCallRepository->deletePhoneSmsService($campaign_api_id);
            if ($delete) {
                $value = PhoneSmsCampaign::query()->where('campaign_api_id', $campaign_api_id)->first();
                if ($value) {
                    $data['deleted_by'] = userInfo()->id;
                    DB::beginTransaction();
                    $this->model->update($data, $value->id);
                    //delete data
                    $this->model->delete($value->id);
                    DB::commit();
                    session()->flash('success', Lang::get('message.flash_messages.deleteMessage'));
                }
            }

            return response()->json([
                'status' => true,
                'success' => Lang::get('message.flash_messages.deleteMessage'),
            ]);
            // return back();
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function show($id, Request $request)
    {

        try {
            $hashId = new Hashids('', hashIdLen());
            $hashIdValue = $hashId->decode($id);
            if ($hashIdValue) {

                $data['page_title'] = getLan() == 'np' ? 'Phone/SMS  व्यवस्थापन' : 'Phone/SMS management';
                $data['page_url'] = 'phoneSmsManagement';
                $data['page_route'] = 'phoneSmsManagement';
                $data['cancel_button'] = true;
                $data['index_page_url'] = 'phoneSmsManagement';

                $data['campaignDetails'] = PhoneSmsCampaign::query()->find($hashIdValue[0])->first();
                //                $detailsInfo = $this->voiceCallRepository->detailsPhoneSmsService($data['campaignDetails']->campaign_api_id);
                //                $data['detail'] = $detailsInfo['data']['details'];
                // $data['numberList'] = $this->voiceCallRepository->numberListPhoneSmsService($data['campaignDetails']->campaign_api_id);
                $data['numberList'] = $this->voiceCallRepository->numberListPhoneSmsService($data['campaignDetails']->campaign_api_id, '', $request->number);
                $data['load_css'] = [
                    'plugins/datepicker/english/english-datepicker.css',
                    'plugins/datepicker/nepali/css/nepali.datepicker.v3.2.min.css',

                ];
                $data['load_js'] = [
                    'plugins/datepicker/english/english-datepicker.min.js',
                    'plugins/datepicker/nepali/js/nepali.datepicker.v3.2.min.js',
                    'plugins/input-mask/jquery/inputmask.min.js',
                    'plugins/input-mask/jquery/date_extension.min.js',
                    'js/custom_app.js',
                    'js/voiceCallManagement/phoneSms.js',
                    'js/voiceCallManagement/schedule.js',

                ];
                $data['script_js'] = "$(function(){
                       $('.mobileNo').inputmask('9999999999', { placeholder: '' });
                    })";
                $data['request'] = $request;

                return view('backend.voiceCallManagement.phoneSms.campaign.show', $data);

            } else {

                Session::flash('error', Lang::get('message.flash_messages.dataNotFoundMessage'));

                return redirect('phoneSmsManagement');
            }

        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function addMobileNumber(Request $request)
    {
        try {

            $value = $this->voiceCallRepository->addNumberPhoneSmsService($request);
            if ($value) {
                $campaignNumberData = [
                    'fy_id' => currentFy()->id,
                    'client_id' => clientInfo()->id,
                    'campaign_id' => $request->campaign_id,
                    'campaign_api_id' => $request->campaign_api_id,
                    'api_number_id' => $value['data']['number-lists']['id'],
                    'number' => $value['data']['number-lists']['number'],
                    'status' => $value['data']['number-lists']['status'],
                    'created_by' => userInfo()->id,
                ];
                DB::beginTransaction();
                $create = PhoneSmsCampaignNumber::create($campaignNumberData);
                $this->insertCampaignNumberLog($create);
                DB::commit();
            }
            session()->flash('success', Lang::get('message.flash_messages.insertMessage'));

            return response()->json([
                'status' => true,
                'url' => hashIdGenerate($request->campaign_id),
                'success' => Lang::get('message.flash_messages.insertMessage'),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function updateMobileNumber(Request $request)
    {
        try {

            $value = $this->voiceCallRepository->updateNumberPhoneSmsService($request);
            if ($value) {
                $data = PhoneSmsCampaignNumber::query()->where('id', $request->number_id)->first();
                if ($data) {
                    PhoneSmsCampaignNumber::query()
                        ->where('id', $request->number_id)
                        ->update(['number' => $request->number, 'updated_by' => $request->updated_by]);
                }
                $this->insertCampaignNumberLog($data);
                session()->flash('success', Lang::get('message.flash_messages.updateMessage'));
            }

            return response()->json([
                'status' => true,
                'url' => hashIdGenerate($request->campaign_id),
                'success' => Lang::get('message.flash_messages.insertMessage'),
            ]);
            // return back();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function deleteMobileNumber(Request $request)
    {
        try {
            $delete = $this->voiceCallRepository->deleteNumberPhoneSmsService($request);

            if ($delete) {
                $value = PhoneSmsCampaignNumber::query()->where('id', $request->number_id)->first();

                if ($value) {
                    $data['deleted_by'] = userInfo()->id;
                    DB::beginTransaction();
                    //  $this->model->update($data, $value->id);
                    //delete data
                    $value->delete();
                    DB::commit();
                    session()->flash('success', Lang::get('message.flash_messages.deleteMessage'));
                }
            }

            return response()->json([
                'status' => true,
                'url' => hashIdGenerate($request->campaign_id),
                'success' => Lang::get('message.flash_messages.deleteMessage'),
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function runCampaign(Request $request)
    {
        try {
            $data = $this->voiceCallRepository->runCampaign($request);
            if ($data['status'] == true) {
                #get latest status from campaign api
                $detailsInfo = $this->voiceCallRepository->detailsPhoneSmsService($request->campaign_api_id);
                #check reschedule  campaign
                $campaignInfo =  PhoneSmsCampaign::query()->where('campaign_api_id', $request->campaign_api_id)->first();
                if($campaignInfo)
                {
                    PhoneSmsCampaign::query()->where('campaign_api_id', $request->campaign_api_id)
                        ->update([
                            'campaign_status' => $detailsInfo['data']['details']['status'],
                            'campaign_re_run_by' => userInfo()->id,
                            'campaign_re_run_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                            'campaign_re_run_date_en' => Carbon::now(),
                        ]);
                    $request['action_name'] = 'Campaign Re Run';
                    $this->voiceCallRepository->storeCampaignLog($request);
                }else{
                    PhoneSmsCampaign::query()->where('campaign_api_id', $request->campaign_api_id)
                        ->update([
                            'campaign_status' => $detailsInfo['data']['details']['status'],
                            'campaign_run_by' => userInfo()->id,
                            'campaign_run_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                            'campaign_run_date_en' => Carbon::now(),
                        ]);
                    $request['action_name'] = 'Campaign Run';
                    $this->voiceCallRepository->storeCampaignLog($request);
                }

            # add campaign message data
            $this->voiceCallRepository->addCampaignMessage($request);


            } else {
                Session::flash('server_error', Lang::get('message.commons.technicalError'));

                return back();
            }
            session()->flash('success', Lang::get('Campaign  Successfully Run'));

            return back();
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function insertCampaignNumberLog($data)
    {
        try {
            $campaignNumberData = [
                'number_id' => $data->id,
                'number_api_id' => $data->api_number_id,
                'status' => $data->status,
                'date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'date_en' => Carbon::now(),
                'created_by' => userInfo()->id,
            ];

            return PhoneSmsCampaignNumberLog::create($campaignNumberData);

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
