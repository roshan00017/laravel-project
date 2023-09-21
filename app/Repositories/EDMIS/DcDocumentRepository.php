<?php

namespace App\Repositories\EDMIS;

use App\Helpers\DateConverter;
use App\Models\EDMIS\DcDocument;
use App\Repositories\CommonRepository;

class DcDocumentRepository
{
    private DateConverter $dateConverter;

    private DcDocument $dcDocument;

    public function __construct(DateConverter $dateConverter, DcDocument $dcDocument)
    {
        $this->dateConverter = $dateConverter;
        $this->dcDocument = $dcDocument;
    }

    public function getAllDocument($request)
    {
        $result = $this->dcDocument;
        if (getLan() == 'np') {
            $date = 'regd_date_bs';
        } else {
            $date = 'regd_date_ad';
        }

        if ($request->document_no != null) {
            $result = $result->where('document_n0', $request->document_no);
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
