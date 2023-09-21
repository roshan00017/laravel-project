<?php

namespace App\Repositories;

use App\Models\CallRouting\CallRoutingNumberManagement;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class CallRoutingRepository
{
    private CallRoutingNumberManagement $callRouting;

    public function __construct(CallRoutingNumberManagement $callRouting)
    {

        $this->callRouting = $callRouting;
    }

    public function getAllRecorded($request)
    {
        $result = $this->callRouting;

        if ($request->search_type != null) {
            $result = $result->where('type', $request->search_type);
        }

        if ($request->number != null) {
            $result = $result->where('number', $request->number);
        }

        //check client id
        CommonRepository::checkClientId($result);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function updateCallRoutingNumber($request)
    {
        try {
            if ($request->type == 'ambulance_number') {
                $ambulance_number = $request->number;
            } else {
                $numberInfo = $this->callRouting->where(['type' => 'ambulance_number', 'client_id' => clientInfo()->id])->first();
                $ambulance_number = $numberInfo->number;
            }
            if ($request->type == 'firebrigade_number') {
                $firebrigade_number = $request->number;
            } else {
                $numberInfo = $this->callRouting->where(['type' => 'firebrigade_number', 'client_id' => clientInfo()->id])->first();
                $firebrigade_number = $numberInfo->number;
            }
            if ($request->type == 'police_number') {
                $police_number = $request->number;
            } else {
                $numberInfo = $this->callRouting->where(['type' => 'police_number', 'client_id' => clientInfo()->id])->first();
                $police_number = $numberInfo->number;
            }
            //fist update call routing
            $client = new Client();
            $options = [
                'multipart' => [
                    [
                        'name' => 'police_number',
                        'contents' => $police_number,
                    ],
                    [
                        'name' => 'ambulance_number',
                        'contents' => $ambulance_number,
                    ],
                    [
                        'name' => 'firebrigade_number',
                        'contents' => $firebrigade_number,
                    ],
                ],
            ];
            $request = new Request('POST', 'https://calltest.prixa.net/emergency_numbers');
            //$res = $client->sendAsync($request, $options)->wait();
            // return json_decode($res->getBody(), true);
            return $client->sendAsync($request, $options)->wait();

        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('server_error', Lang::get('message.commons.technicalError'));

            return back();
        }
    }
}
