<?php

namespace App\Helpers;

class SmsHelper
{
    //set sms helper  info
    public static function sendSms($mobile = null, $message = null)
    {
        $mobile = '+977'.$mobile;
        $smsSettingInfo = smsSetting(clientInfo()->id);

        $token = $smsSettingInfo->sms_token;

        //check service provide name
        if ($smsSettingInfo->sms_provider_name == 'DOIT') {

            $url = $smsSettingInfo->sms_ur ? $smsSettingInfo->sms_url : 'https://sms.doit.gov.np/api/sms';
            $data = "{\"mobile\":\"$mobile\",\"message\":\"$message\"}";

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    "Authorization: Bearer $token",
                ],
            ]);

            $response = curl_exec($curl);

            curl_close($curl);
        } elseif ($smsSettingInfo->sms_provider_name == 'SPARROW') {
            $curl = curl_init();
            $args = http_build_query([
                'token' => $token,
                'from' => $smsSettingInfo->sms_fromn,
                'to' => $mobile,
                'text' => $message]);

            // Make the call using API.
            $url = $smsSettingInfo->sms_ur ? $smsSettingInfo->sms_url : 'http://api.sparrowsms.com/v2/sms/';

            // Make the call using API.
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            // Response
            $response = curl_exec($ch);
            $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            return $status_code;
        }

    }
}
