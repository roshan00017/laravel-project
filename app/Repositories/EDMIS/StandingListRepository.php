<?php

namespace App\Repositories\EDMIS;

use App\Models\EDMIS\StandingList;
use App\Repositories\CommonRepository;

class StandingListRepository
{
    private StandingList $standingList;

    public function __construct(StandingList $standingList)
    {
        $this->standingList = $standingList;
    }

    public function getAllStandingList($request)
    {
        $result = $this->standingList;

        if ($request->code != null) {
            $result = $result->where('code', $request->code);
        }

        if ($request->date != null) {
            $result = $result->where(function ($query) use ($request) {
                $query->where('date_en', $request->date)
                    ->orWhere('date_np', $request->date);
            });
        }

        if ($request->organization != null) {
            $result = $result->where('organization', $request->organization);
        }

        if ($request->type != null) {
            $result = $result->where('type', $request->type);
        }

        if ($request->physical_year_id != null) {
            $result = $result->where('physical_year_id', $request->physical_year_id);
        }

        if ($request->regd_no != null) {
            $result = $result->where('regd_no', $request->regd_no);
        }

        // Check client id
        CommonRepository::checkClientId($result);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}
