<?php

namespace App\Repositories\EDMIS;

use App\Helpers\DateConverter;
use App\Models\EDMIS\DcDispatchBook;
use App\Models\EDMIS\DcDocument;
use App\Models\EDMIS\DcRegisterBook;
use App\Repositories\CommonRepository;

class MasterSearchRepository
{
    private DateConverter $dateConverter;

    private DcDispatchBook $dcDispatchBook;

    private DcRegisterBook $dcRegisterBook;

    private DcDocument $dcDocument;

    public function __construct(DateConverter $dateConverter, DcDocument $dcDocument, DcRegisterBook $dcRegisterBook, DcDispatchBook $dcDispatchBook)
    {
        $this->dateConverter = $dateConverter;
        $this->dcDispatchBook = $dcDispatchBook;
        $this->dcRegisterBook = $dcRegisterBook;
        $this->dcDocument = $dcDocument;
    }

    public function getAllDispatchBookFilterData($request)
    {
        $result = $this->dcDispatchBook;
        if (getLan() == 'np') {
            $date = 'dispatch_date_bs';
        } else {
            $date = 'dispatch_date_ad';
        }

        if ($request->dispatch_no != null) {
            $result = $result->where('dispatch_no', $request->dispatch_no);
        }

        if ($request->letter_no != null) {
            $result = $result->where('letter_no', $request->letter_no);
        }
        if ($request->file_type != null) {
            $result = $result->where('file_type', $request->file_type);
        }

        if ($request->letter_no != null) {
            $result = $result->where('letter_no', $request->letter_no);
        }

        if ($request->letter_status != null) {
            $result = $result->where('letter_status', $request->letter_status);

        }
        if ($request->ward_no != null) {
            $result = $result->where('ward_no', $request->ward_no);

        }

        if ($request->sent_medium_id != null) {
            $result = $result->where('sent_medium_id', $request->sent_medium_id);

        }

        if ($request->to_office_id != null) {
            $result = $result->where('to_office_id', $request->to_office_id);

        }

        if ($request->country_id != null) {
            $result = $result->where('country_id', $request->country_id);

        }

        if ($request->from_branch_id != null) {
            $result = $result->where('from_branch_id', $request->from_branch_id);

        }

        if ($request->contact_person != null) {
            $result = $result->where('contact_person', 'LIKE', '%'.$request->contact_person.'%');
        }

        if ($request->contact_address != null) {
            $result = $result->where('contact_address', 'LIKE', '%'.$request->contact_address.'%');
        }

        if ($request->contact_no != null) {
            $result = $result->where('contact_no', 'LIKE', '%'.$request->contact_no.'%');
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

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getAllDartaKitabFilterData($request)
    {
        $result = $this->dcRegisterBook;
        if (getLan() == 'np') {
            $date = 'regd_date_bs';
        } else {
            $date = 'regd_date_ad';
        }

        if ($request->user_id != null) {
            $result = $result->where('added_by', $request->user_id);
        }

        if ($request->dispatch_no != null) {
            $result = $result->where('dispatch_no', $request->dispatch_no);
        }
        if ($request->reg_id != null) {
            $result = $result->where('regd_no', $request->reg_id);

        }
        if ($request->ward_no != null) {
            $result = $result->where('ward_no', $request->ward_no);

        }

        if ($request->regd_no != null) {
            $result = $result->where('regd_no', $request->regd_no);
        }

        if ($request->letter_no != null) {
            $result = $result->where('letter_no', $request->letter_no);
        }

        if ($request->letter_sub != null) {
            $result = $result->where('letter_sub', 'LIKE', '%'.$request->letter_sub.'%');
        }

        if ($request->fy_code != null) {
            $result = $result->where('fiscal_year_id', $request->fy_code);
        }

        if ($request->letter_status != null) {
            $result = $result->where('letter_status', $request->letter_status);
        }

        if ($request->first_person_id != null) {
            $result = $result->where('first_person_id', $request->first_person_id);
        }

        if ($request->to_branch_id != null) {
            $result = $result->where('to_branch_id', $request->to_branch_id);
        }
        if ($request->contact_person != null) {
            $result = $result->where('contact_person', 'LIKE', '%'.$request->contact_person.'%');
        }

        if ($request->contact_address != null) {
            $result = $result->where('contact_address', 'LIKE', '%'.$request->contact_address.'%');
        }

        if ($request->contact_no != null) {
            $result = $result->where('contact_no', 'LIKE', '%'.$request->contact_no.'%');
        }

        if ($request->from_off_id != null) {
            $result = $result->where('from_off_id', $request->from_off_id);
        }

        if ($request->country_id != null) {
            $result = $result->where('country_id', $request->country_id);
        }

        if ($request->employee_id != null) {
            $result = $result->where('employee_id', $request->employee_id);

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

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function getAllDocumentFilterData($request)
    {
        $result = $this->dcDocument;
        if (getLan() == 'np') {
            $date = 'regd_date_bs';
        } else {
            $date = 'regd_date_ad';
        }

        if ($request->document_no != null) {
            $result = $result->where('ward_no   ', $request->document_no);
        }

        if ($request->document_type_id != null) {
            $result = $result->where('document_type_id', $request->document_type_id);
        }

        if ($request->from_section_id != null) {
            $result = $result->where('from_section_id', $request->from_section_id);
        }

        if ($request->to_section_id != null) {
            $result = $result->where('letter_no', $request->to_section_id);
        }

        if ($request->added_on != null) {
            $result = $result->where('added_on', $request->added_on);
        }

        if ($request->added_by != null) {
            $result = $result->where('added_by', $request->added_by);
        }

        if ($request->fiscal_year_id != null) {
            $result = $result->where('fiscal_year_id', $request->fiscal_year_id);

        }
        if ($request->file_status_id != null) {
            $result = $result->where('file_status_id', $request->file_status_id);

        }

        if ($request->filepath != null) {
            $result = $result->where('filepath', $request->filepath);

        }

        if ($request->remarks != null) {
            $result = $result->where('remarks', $request->remarks);

        }

        //check client id
        CommonRepository::checkClientId($result);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}
