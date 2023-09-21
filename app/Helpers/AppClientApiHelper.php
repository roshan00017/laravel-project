<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class AppClientApiHelper
{
    public static function getClientInfo($apiPath)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => clientInfo()->api_web_url.'/'.$apiPath,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ]);

            $response = curl_exec($curl);
            $responseData = json_decode($response, true);
            if ($responseData) {
                $data = paginate($responseData);
            } else {
                $data = 500;
            }

            return $data;

        } catch (\Exception $e) {
            DB::rollback();
        }

    }

    public static function getApiData($apiPath)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => clientInfo()->api_web_url.'/'.$apiPath,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ]);

            $response = curl_exec($curl);

            return json_decode($response, true);

        } catch (\Exception $e) {
            DB::rollback();
        }

    }
}
