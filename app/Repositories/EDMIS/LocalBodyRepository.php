<?php

namespace App\Repositories\EDMIS;

use App\Models\MasterSettings\LocalBody;
use App\Repositories\CommonRepository;

class LocalBodyRepository
{
    private LocalBody $localBody;

    public function __construct(LocalBody $localBody)
    {
        $this->localBody = $localBody;
    }

    public function getAllLocalBodies($request)
    {
        $result = $this->localBody;

        if ($request->province_code != null) {
            $result = $result->where('province_code', $request->province_code);
        }

        if ($request->district_code != null) {
            $result = $result->where('district_code', $request->district_code);
        }

        if ($request->total_ward != null) {
            $result = $result->where('total_ward', $request->total_ward);
        }

        if ($request->name_en != null) {
            $result = $result->where('name_en', $request->name_en);
        }

        if ($request->name_np != null) {
            $result = $result->where('name_np', $request->name_np);
        }

        if ($request->code != null) {
            $result = $result->where('code', $request->code);
        }

        if ($request->web_url != null) {
            $result = $result->where('web_url', $request->web_url);
        }

        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }

        // Check client id
        CommonRepository::checkClientId($result);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}
