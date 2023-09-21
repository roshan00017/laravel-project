<?php

namespace App\Repositories\DCC;

use App\Models\TokenManagement\Token;
use App\Models\TokenManagement\TokenLog;
use App\Repositories\CommonRepository;

class TokenManagementRepository
{
    private Token $token;

    private TokenLog $tokenLog;

    public function __construct(Token $token, TokenLog $tokenLog)
    {

        $this->token = $token;
        $this->tokenLog = $tokenLog;
    }

    public function getAllServiceRelatedToken($request)
    {
        $result = $this->token;

        if ($request->token_no != null) {
            $result = $result->where('token_no', $request->token_no);

        }
        if (getLan() == 'np') {
            $date = 'date_np';
        } else {
            $date = 'date_en';
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
        if ($request->module_name != null) {
            $result = $result->where('module_name', $request->module_name);

        }
        if ($request->module_service_name != null) {
            $result = $result->where('module_service_name', $request->module_service_name);

        }

        //check client id
        CommonRepository::checkClientId($result);
        //today data get by dashboard
        if ($request->today != null) {
            $result = $result->where('date_en', decrypt($request->today));
        }
        //request check fiscal year
        CommonRepository::fiscalYearData($result, $request);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getAllServiceRelatedTokenLog($request)
    {
        $result = $this->tokenLog;

        if ($request->token_no != null) {
            $result = $result->where('token_no', $request->token_no);

        }
        if (getLan() == 'np') {
            $date = 'date_np';
        } else {
            $date = 'date_en';
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
        if ($request->module_status_id != null) {
            $result = $result->where('module_status_id', $request->module_status_id);

        }

        //check client id
        CommonRepository::checkClientId($result);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function serviceTokenLogDetailsByToken($token_no)
    {
        $result = $this->tokenLog;

        //check client id
        CommonRepository::checkClientId($result);

        return $result
            ->where('token_no', $token_no)
            ->orderBy('id', 'DESC')
            ->get();
    }
}
