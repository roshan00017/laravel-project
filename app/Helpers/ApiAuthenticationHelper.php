<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class ApiAuthenticationHelper
{
    public static function authApi($authType, $message = null)
    {
        try {
            if ($authType == 'ting-ting') {

                $client = new Client();
                $options = [
                    'multipart' => [
                        [
                            'name' => 'email',
                            'contents' => settingInfo('CSAUN') ? settingInfo('CSAUN') : config('client.call_sms_api_user_name'),
                        ],
                        [
                            'name' => 'password',
                            'contents' => settingInfo('CSAUP') ? settingInfo('CSAUP') : config('client.call_sms_api_user_password'),
                        ],
                    ]];
                $request = new Request('POST', settingInfo('CSAU') ? settingInfo('CSAU') : config('client.call_sms_api_url').'/accounts/login/');
                $res = $client->sendAsync($request, $options)->wait();

                return json_decode($res->getBody(), true);
            } elseif ($authType == 'riri') {

                $client = new Client();
                $headers = [
                    'Authorization' => settingInfo('VRAT') ? settingInfo('VRAT') : 'Token'.' '.config('client.voice_api_token'),
                ];
                $options = [
                    'multipart' => [
                        [
                            'name' => 'text',
                            'contents' => $message,
                        ],
                        [
                            'name' => 'voice',
                            'contents' => settingInfo('VRAVT') ? settingInfo('VRAVT') : config('client.voice_api_type'),
                        ],
                    ]];
                $request = new Request('POST', settingInfo('VRAU') ? settingInfo('VRAU') : config('client.voice_api_url'), $headers);
                $res = $client->sendAsync($request, $options)->wait();

                return json_decode($res->getBody(), true);
            }
        } catch (\Exception $e) {

        }

    }
}
