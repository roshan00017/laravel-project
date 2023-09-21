<?php

namespace App\Repositories;

use App\Facades\NepaliDate;
use App\Helpers\DateConverter;
use App\Helpers\VoiceCallManagementHelper;
use App\Models\VoiceCallManagement\AudioFile;
use App\Models\VoiceCallManagement\PhoneSmsCampaign;
use App\Models\VoiceCallManagement\PhoneSmsCampaignLog;
use App\Models\VoiceCallManagement\PhoneSmsCampaignMessage;
use App\Models\VoiceCallManagement\PhoneSmsCampaignNumber;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class VoiceCallManagementRepository
{
    private AudioFile $voice;

    private DateConverter $dateConverter;

    private PhoneSmsCampaign $phoneSmsCampaign;

    public function __construct(AudioFile $voice, DateConverter $dateConverter,
        PhoneSmsCampaign $phoneSmsCampaign)
    {

        $this->voice = $voice;
        $this->dateConverter = $dateConverter;
        $this->phoneSmsCampaign = $phoneSmsCampaign;
    }

    public function getAllRecorded($request)
    {
        $result = $this->voice;

        if (getLan() == 'np') {
            $date = 'generate_date_np';
        } else {
            $date = 'generate_date_en';
        }
        if ($request->module_unique_id != null) {
            $result = $result->where('module_unique_id', $request->module_unique_id);

        }

        if ($request->module_name != null) {
            $result = $result->where('module_name', $request->module_name);

        }
        if ($request->from_date != null && $request->to_date == null) {
            $result = $result
                ->where($date, '>=', $request->from_date);
        }

        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where($date, '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->whereBetween($date, [$request->from_date, $request->to_date]);
        }

        //check client id
        CommonRepository::checkClientId($result);
        //request check fiscal year
        CommonRepository::fiscalYearData($result, $request);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getAllCampaigns($request)
    {
        try {
            $date = getLan() == 'np' ? 'campaign_added_date_np' : 'campaign_added_date_en';

            $result = $this->phoneSmsCampaign;
            if ($request->from_date != null && $request->to_date == null) {
                $result = $result
                    ->where($date, '>=', $request->from_date);
            }

            if ($request->to_date != null && $request->from_date == null) {
                $result = $result
                    ->where($date, '<=', $request->to_date);
            }

            if ($request->from_date != null && $request->to_date != null) {
                $result = $result
                    ->whereBetween($date, [$request->from_date, $request->to_date]);
            }

            if ($request->module_name != null) {
                $result = $result->where('module_name', $request->module_name);
            }

            if ($request->module_unique_id != null) {
                $result = $result->where('module_unique_id', $request->module_unique_id);
            }

            if ($request->services != null) {
                $result = $result->where('campaign_service', $request->services);
            }

            //today data get by dashboard
            if ($request->today != null) {
                $result = $result->where('campaign_added_date_en', decrypt($request->today));
            }
            //status by dashboard
            if ($request->status != null) {
                $result = $result->where('campaign_status', decrypt($request->status));

            }

            if (userInfo()->role_id > 2) {
                CommonRepository::checkClientId($result);
            }

            //request check fiscal year
            CommonRepository::fiscalYearData($result, $request);

            return $result
                ->orderBy('id', 'DESC')
                ->paginate(10);

            //            $client = new Client();
            //            $headers = [
            //                'Authorization' => 'Bearer' . ' ' . VoiceCallManagementHelper::tingTingAccessToken()
            //            ];
            //            $request = new Request('GET', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url') . '/system/campaigns', $headers);
            //            $res = $client->sendAsync($request)->wait();
            //            $responseData = json_decode($res->getBody(), true);
            //            if ($responseData) {
            //                $collectionData = collect($responseData['result']['campaign-lists']);
            //                $data = paginate($collectionData);
            //            } else {
            //                $data = 500;
            //            }
            //            return $data;
        } catch (\Exception $e) {

        }
    }

    public function addPhoneSmsService($request, $file = null)
    {
        try {
            $client = new Client();
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer'.' '.VoiceCallManagementHelper::tingTingAccessToken(),
            ];
            if ($request->send_medium == 1) {

                $mainBody = [
                    'name' => $request->name,
                    'services' => $request->services,
                    'individual_number' => [(int) $request->individual_number],
                    'description' => $request->description,
                ];
                $body = json_encode($mainBody);
                $request = new Request('POST', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/campaigns/', $headers, $body);
                $res = $client->sendAsync($request)->wait();

                return json_decode($res->getBody(), true);
            } else {

                $options = [
                    'multipart' => [
                        [
                            'name' => 'name',
                            'contents' => $request->name,
                        ],
                        [
                            'name' => 'services',
                            'contents' => $request->services,
                        ],
                        [
                            'name' => 'send_to_number_file',
                            'contents' => Utils::tryFopen($request->send_to_number_file, 'r'),
                            'filename' => $file,
                            'headers' => [
                                'Content-Type' => '<Content-type header>',
                            ],
                        ],
                    ]];
                $request = new Request('POST', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/campaigns/', $headers);
                $res = $client->sendAsync($request, $options)->wait();

                return json_decode($res->getBody(), true);
            }

        } catch (\Exception $e) {
        }
    }

    public function updatePhoneSmsService($request, $campaign_api_id)
    {
        try {
            $client = new Client();
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer'.' '.VoiceCallManagementHelper::tingTingAccessToken(),
            ];

            $mainBody = [
                'name' => $request->campaign_name,
                'services' => $request->campaign_service,
                'description' => $request->campaign_detail,
            ];
            $body = json_encode($mainBody);
            $request = new Request('PUT', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/campaigns/'.$campaign_api_id.'/update/', $headers, $body);
            $res = $client->sendAsync($request)->wait();

            return json_decode($res->getBody(), true);

        } catch (\Exception $e) {
        }
    }

    public function deletePhoneSmsService($campaign_id)
    {
        try {
            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer'.' '.VoiceCallManagementHelper::tingTingAccessToken(),
            ];
            $request = new Request('DELETE', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/campaigns/'.$campaign_id.'/delete/', $headers);
            $res = $client->sendAsync($request)->wait();

            return json_decode($res->getBody(), true);

        } catch (\Exception $e) {
        }
    }

    public function detailsPhoneSmsService($id)
    {
        try {
            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer'.' '.VoiceCallManagementHelper::tingTingAccessToken(),
            ];
            $request = new Request('GET', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/campaigns/'.$id.'/details/', $headers);
            $res = $client->sendAsync($request)->wait();

            return json_decode($res->getBody(), true);

        } catch (\Exception $e) {
        }
    }

    public function numberListPhoneSmsService($campaign_id, $method_data = null, $request = null)
    {
        try {
            if ($method_data == 'api') {
                //data fetch by api
                $client = new Client();
                $headers = [
                    'Authorization' => 'Bearer'.' '.VoiceCallManagementHelper::tingTingAccessToken(),
                ];
                $request = new Request('GET', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/campaigns/number/'.$campaign_id, $headers);
                $res = $client->sendAsync($request)->wait();

                return json_decode($res->getBody(), true);
            } else {
                $query = PhoneSmsCampaignNumber::query();
                if ($request != null) {
                    $query = $query->where('number', $request->number);
                }

                return $query->where('campaign_api_id', $campaign_id)
                    ->orderBy('id', 'DESC')
                    ->paginate(10);
            }

            //            if ($responseData) {
            //                $collectionData = collect($responseData['data']['number-lists']);
            //                $data = paginate($collectionData);
            //            } else {
            //                $data = 500;
            //            }
            //            return $data;

        } catch (\Exception $e) {
        }
    }

    public function addNumberPhoneSmsService($request)
    {
        try {
            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer'.' '.VoiceCallManagementHelper::tingTingAccessToken(),
            ];

            $options = [
                'multipart' => [
                    [
                        'name' => 'number',
                        'contents' => $request->number,
                    ],
                ]];

            $request = new Request('POST', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/campaigns/number/'.$request->campaign_api_id.'/', $headers);
            $res = $client->sendAsync($request, $options)->wait();

            return json_decode($res->getBody(), true);

        } catch (\Exception $e) {
        }
    }

    public function updateNumberPhoneSmsService($request)
    {
        try {
            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer'.' '.VoiceCallManagementHelper::tingTingAccessToken(),
            ];

            $options = [
                'multipart' => [
                    [
                        'name' => 'number',
                        'contents' => $request->number,
                    ],
                ]];
            $request = new Request('PUT', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/number/'.$request->api_number_id.'/', $headers);
            $res = $client->sendAsync($request, $options)->wait();

            return json_decode($res->getBody(), true);

        } catch (\Exception $e) {
        }
    }

    public function detailsCampaignNumber($api_number_id)
    {
        try {
            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer'.' '.VoiceCallManagementHelper::tingTingAccessToken(),
            ];

            $request = new Request('GET', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/number/'.$api_number_id.'/', $headers);
            $res = $client->sendAsync($request)->wait();

            return json_decode($res->getBody(), true);

        } catch (\Exception $e) {
        }
    }

    public function deleteNumberPhoneSmsService($request)
    {
        try {
            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer'.' '.VoiceCallManagementHelper::tingTingAccessToken(),
            ];

            $request = new Request('DELETE', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/campaigns/number/'.$request->api_number_id.'/delete/', $headers);
            $res = $client->sendAsync($request)->wait();

            return json_decode($res->getBody(), true);

        } catch (\Exception $e) {
        }
    }

    public function runCampaign($request)
    {
        try {

            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer'.' '.VoiceCallManagementHelper::tingTingAccessToken(),
            ];

            //option for schedule
            if ($request->is_schedule == 1) {
                if (getLan() == 'np') {
                    $dateSplit = explode('-', $request->date_bs);
                    $npDate = $this->dateConverter->nep_to_eng($dateSplit[0], $dateSplit[1], $dateSplit[2]);
                    $finalDateTime = $npDate.'T'.$request->time;

                } else {
                    $finalDateTime = $request->date_ad.'T'.$request->time;
                }

                if ($request->campaign_service == 'PHONE') {

                    $options = [
                        'multipart' => [
                            [
                                'name' => 'message',
                                'contents' => $request->message,
                            ],
                            [
                                'name' => 'voice_input',
                                'contents' => $request->voice_input,
                            ],
                            [
                                'name' => 'schedule_date',
                                'contents' => $finalDateTime,
                            ],
                        ]];
                } else {

                    $options = [
                        'multipart' => [
                            [
                                'name' => 'message',
                                'contents' => $request->message,
                            ],
                            [
                                'name' => 'schedule_date',
                                'contents' => $finalDateTime,
                            ],
                        ]];
                }
            } else {
                if ($request->campaign_service == 'SMS') {

                    $options = [
                        'multipart' => [
                            [
                                'name' => 'message',
                                'contents' => $request->message,
                            ],
                        ]];
                } else {

                    $options = [
                        'multipart' => [
                            [
                                'name' => 'message',
                                'contents' => $request->message,
                            ],
                            [
                                'name' => 'voice_input',
                                'contents' => $request->voice_input,
                            ],
                        ]];
                }
            }
            $request = new Request('POST', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/campaigns/'.$request->campaign_api_id.'/begin/', $headers);
            $res = $client->sendAsync($request, $options)->wait();

            return json_decode($res->getBody(), true);

        } catch (\Exception $e) {
        }
    }

    public function addCampaign($result)
    {
        try {

            $client = new Client();
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer'.' '.VoiceCallManagementHelper::tingTingAccessToken(),
            ];
            $request = new Request('POST', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/campaigns/', $headers, $result);
            $res = $client->sendAsync($request)->wait();

            return json_decode($res->getBody(), true);

        } catch (\Exception $e) {
        }
    }

    //campaign manage in our local system

    public function storeNewCampaign($result)
    {
        try {
            $campaignData = [
                'fy_id' => currentFy()->id,
                'client_id' => userInfo()->client_id,
                'module_name' => $result['module_name'],
                'module_unique_id' => $result['module_unique_id'],
                'campaign_name' => $result['campaign_name'],
                'campaign_detail' => $result['campaign_detail'],
                'campaign_number_count' => $result['campaign_number_count'],
                'campaign_service' => $result['campaign_service'],
                'campaign_status' => $result['campaign_status'],
                'campaign_api_id' => $result['campaign_api_id'],
                'campaign_added_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'campaign_added_date_en' => Carbon::now(),
                'created_by' => userInfo()->id,
            ];
            $campaignData = PhoneSmsCampaign::create($campaignData);
            $this->storeCampaignLog($campaignData);

            return $campaignData;
        } catch (\Exception $e) {
        }
    }

    public function storeCampaignLog($result)
    {
        try {
            $campaignData = [
                'fy_id' => currentFy()->id,
                'client_id' => userInfo()->client_id,
                'campaign_id' => $result['campaign_id'],
                'campaign_api_id' => $result['campaign_api_id'],
                'service_type' => $result['campaign_service'],
                'action_name' => $result['action_name'],
                'action_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'action_date_en' => Carbon::now(),
                'action_by' => userInfo()->id,
            ];

            return PhoneSmsCampaignLog::create($campaignData);

        } catch (\Exception $e) {
        }
    }

    public function getAllApiCampaign()
    {
        try {
            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer'.' '.VoiceCallManagementHelper::tingTingAccessToken(),
            ];
            $request = new Request('GET', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/system/campaigns', $headers);
            $res = $client->sendAsync($request)->wait();
            $responseData = json_decode($res->getBody(), true);
            if ($responseData) {
                $collectionData = collect($responseData['result']['campaign-lists']);
                $data = paginate($collectionData);
            } else {
                $data = 500;
            }

            return $data;
        } catch (\Exception $e) {
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }

    public function addCampaignMessage($result)
    {
        try {
            $campaignMessageData = [
                'fy_id' => currentFy()->id,
                'client_id' => userInfo()->client_id,
                'module_name' => $result['module_name'],
                'campaign_id' => $result['campaign_id'],
                'campaign_api_id' => $result['campaign_api_id'],
                'service_type' => $result['campaign_service'],
                'voice_input' => $result['voice_input'],
                'message' => $result['message'],
                'is_schedule' => $result['is_schedule'],
                'schedule_date_np' => $result['is_schedule'] ? NepaliDate::create(Carbon::now())->toBS() : NULL ,
                'schedule_date_en' => $result['is_schedule'] ? Carbon::now() : NULL ,
                'action_date_np' => NepaliDate::create(Carbon::now())->toBS(),
                'action_date_en' => Carbon::now(),
                'audio_file' => $result['audio_file'],
                'action_by' => userInfo()->id,
            ];

            return PhoneSmsCampaignMessage::create($campaignMessageData);

        } catch (\Exception $e) {
        }
    }
}
