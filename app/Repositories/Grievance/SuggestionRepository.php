<?php

namespace App\Repositories\Grievance;

use App\Helpers\DateConverter;
use App\Models\Grevience\Suggestion;
use App\Repositories\CommonRepository;

class SuggestionRepository
{
    private DateConverter $dateConverter;

    private Suggestion $suggestion;

    public function __construct(DateConverter $dateConverter, Suggestion $suggestion)
    {
        $this->dateConverter = $dateConverter;
        $this->suggestion = $suggestion;
    }

    public function getAllSuggestions($request)
    {
        if (getLan() == 'np') {
            $date = 'submit_date_np';
        } else {
            $date = 'submit_date_en';
        }
        $result = $this->suggestion;
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

        if ($request->suggestion_category_id != null) {
            $result = $result->where('suggestion_category_id', $request->suggestion_category_id);
        }
        if (userInfo()->client_id != null) {
            $result = $result->where('client_id', userInfo()->client_id);
        }

        //today data get by dashboard
        if ($request->today != null) {
            $result = $result->where('submit_date_en', decrypt($request->today));
        }

        //request check fiscal year
        CommonRepository::fiscalYearData($result, $request);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getSuggestionById($id)
    {

        $result = $this->suggestion->findOrFail($id);

        return $result;

    }
}
