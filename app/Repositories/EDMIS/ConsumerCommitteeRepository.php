<?php

namespace App\Repositories\EDMIS;

use App\Helpers\DateConverter;
use App\Models\EDMIS\ConsumerCommittee;
use App\Repositories\CommonRepository;

class ConsumerCommitteeRepository
{
    private DateConverter $dateConverter;

    private ConsumerCommittee $consumerCommittee;

    public function __construct(DateConverter $dateConverter, ConsumerCommittee $consumerCommittee)
    {
        $this->dateConverter = $dateConverter;
        $this->consumerCommittee = $consumerCommittee;
    }

    public function getAllConsumer($request)
    {
        $result = $this->consumerCommittee;
        if (getLan() == 'np') {
            $date = 'regd_date_bs';
        } else {
            $date = 'regd_date_ad';
        }

        if ($request->to_date != null && $request->from_date == null) {
            $result = $result
                ->where($date, '<=', $request->to_date);
        }

        if ($request->from_date != null && $request->to_date != null) {
            $result = $result
                ->whereBetween($date, [$request->from_date, $request->to_date]);
        }

        if ($request->email != null) {
            $result = $result->where('email', $request->email);
            // dd($result);
        }

        if ($request->contact_person_phone != null) {
            $result = $result->where('contact_person_phone', $request->contact_person_phone);
        }

        if ($request->regd_no != null) {
            $result = $result->where('regd_no', $request->regd_no);
        }

        //check client id
        CommonRepository::checkClientId($result);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}
