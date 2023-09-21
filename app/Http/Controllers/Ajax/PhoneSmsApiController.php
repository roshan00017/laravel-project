<?php

namespace App\Http\Controllers\Ajax;

use App\Facades\NepaliDate;
use App\Http\Controllers\Controller;
use App\Models\VoiceCallManagement\PhoneSmsCampaign;
use App\Models\VoiceCallManagement\PhoneSmsCampaignNumber;
use App\Repositories\CommonRepository;
use App\Repositories\VoiceCallManagementRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class PhoneSmsApiController extends Controller
{
    private VoiceCallManagementRepository $voiceCallRepository;

    protected CommonRepository $model;

    public function __construct(VoiceCallManagementRepository $voiceCallRepository, PhoneSmsCampaign $phoneSmsCampaign)
    {
        $this->voiceCallRepository = $voiceCallRepository;
        $this->model = new CommonRepository($phoneSmsCampaign);
    }

    public function addUpdateCampaign()
    {
        try {

            $campaignData = $this->voiceCallRepository->getAllApiCampaign();
            foreach ($campaignData as $value) {
                $existingCampaign = PhoneSmsCampaign::where('campaign_api_id', $value['id'])->first();
                if (! empty($existingCampaign)) {
                    $campaignData = [
                        'campaign_name' => $value['name'],
                        'campaign_service' => $value['services'],
                        'campaign_detail' => $value['description'],
                        'campaign_status' => $value['status'],
                        'campaign_number_count' => $value['number_count'],
                    ];
                    DB::beginTransaction();
                    PhoneSmsCampaign::where('campaign_api_id', $value['id'])->update($campaignData);
                    DB::commit();
                } else {
                    $newCampaignData = [
                        'campaign_api_id' => $value['id'],
                        'campaign_name' => $value['name'],
                        'campaign_service' => $value['services'],
                        'campaign_detail' => $value['description'],
                        'campaign_status' => $value['status'],
                        'campaign_number_count' => $value['number_count'],
                        'module_name' => 'all',
                        'campaign_added_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                        'campaign_added_date_en' => Carbon::now(),
                    ];
                    DB::beginTransaction();
                    $create = PhoneSmsCampaign::create($newCampaignData);
                    //add campaign number
                    $numberList = $this->voiceCallRepository->numberListPhoneSmsService($create->campaign_api_id, 'api');
                    foreach ($numberList['data']['number-lists'] as $key => $number) {
                        $campaignNumberData = [
                            'fy_id' => currentFy()->id,
                            //                            'client_id' => clientInfo()->id,
                            'campaign_id' => $create->id,
                            'campaign_api_id' => $create->campaign_api_id,
                            'api_number_id' => $number['id'],
                            'number' => $number['number'],
                            'status' => $number['status'],
                        ];
                        PhoneSmsCampaignNumber::create($campaignNumberData);

                    }
                    DB::commit();

                    //Session::flash('success', Lang::get('message.flash_messages.insertMessage'));
                }
            }

        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function deleteCampaign()
    {
        try {

            $campaignList = PhoneSmsCampaign::query()->get();
            foreach ($campaignList as $value) {
                $checkApiCampaign = $this->voiceCallRepository->detailsPhoneSmsService($value->campaign_api_id);
                if (is_null($checkApiCampaign)) {
                    DB::beginTransaction();
                    PhoneSmsCampaign::where('id', $value->id)->delete();
                    DB::commit();
                }
            }

        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function addUpdateCampaignNumber(Request $request)
    {
        try {
            if ($request->campaign_id != null) {
                $numberList = $this->voiceCallRepository->numberListPhoneSmsService($request->campaign_id, 'api');
                foreach ($numberList['data']['number-lists'] as $key => $value) {
                    $existingNumber = PhoneSmsCampaignNumber::where('api_number_id', $value['id'])->first();
                    if ($existingNumber) {
                        $numberData = [
                            'api_number_id' => $value['id'],
                            'number' => $value['number'],
                            'status' => $value['status'],
                            // 'available_tags' =>  $value['available_tags'] == '[]' ? null : $value['available_tags'],
                            'duration' => $value['duration'],
                            'playback' => $value['playback'],
                            'credit_consumed' => $value['credit_consumed'],
                        ];
                        DB::beginTransaction();
                        PhoneSmsCampaignNumber::where('api_number_id', $value['id'])->update($numberData);
                        DB::commit();
                    //  Session::flash('success', Lang::get('message.flash_messages.updateMessage'));
                    } else {
                        $numberData = [
                            'api_number_id' => $value['id'],
                            'campaign_api_id' => $request->campaign_id,
                            'number' => $value['number'],
                            'status' => $value['status'],
                            // 'available_tags' =>  $value['available_tags'] == '[]' ? null : $value['available_tags'],
                            'duration' => $value['duration'],
                            'playback' => $value['playback'],
                            'credit_consumed' => $value['credit_consumed'],
                        ];
                        DB::beginTransaction();
                        PhoneSmsCampaignNumber::create($numberData);
                        DB::commit();

                        //Session::flash('success', Lang::get('message.flash_messages.insertMessage'));
                    }
                }
            }

        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function deleteCampaignNumber()
    {
        try {

            $campaignNumberList = PhoneSmsCampaignNumber::query()->get();
            foreach ($campaignNumberList as $value) {
                $checkApiCampaignNumber = $this->voiceCallRepository->detailsCampaignNumber($value->api_number_id);
                if (is_null($checkApiCampaignNumber)) {
                    DB::beginTransaction();
                    PhoneSmsCampaignNumber::where('id', $value->id)->delete();
                    DB::commit();
                }
            }

        } catch (Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }
}
