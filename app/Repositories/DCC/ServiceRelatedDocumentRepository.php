<?php

namespace App\Repositories\DCC;

use App\Models\Dcc\ServiceRelatedDocument;
use App\Repositories\CommonRepository;

class ServiceRelatedDocumentRepository
{
    private ServiceRelatedDocument $serviceRelated;

    public function __construct(ServiceRelatedDocument $serviceRelated)
    {

        $this->serviceRelated = $serviceRelated;
    }

    public function getAllServiceRelated($request)
    {
        $result = $this->serviceRelated;

        if ($request->service_type_id != null) {
            $result = $result->where('service_type_id', $request->service_type_id);
        }

        if ($request->client_id != null) {
            $result = $result->where('client_id', $request->client_id);
        }

        if ($request->service_rate != null) {
            $result = $result->where('service_rate', $request->service_rate);
        }

        if ($request->service_id != null) {
            $result = $result->where('service_id', $request->service_id);
        }

        if ($request->documental_detail_en != null) {
            $result = $result->where('documental_detail_en', 'LIKE', '%'.$request->documental_detail_en.'%');
        }
        if ($request->documental_detail_np != null) {
            $result = $result->where('documental_detail_np', 'LIKE', '%'.$request->documental_detail_en.'%');
        }

        if ($request->fy_code != null) {
            $result = $result->where('fiscal_year_id', $request->fy_code);
        }

        if ($request->service_time != null) {
            $result = $result->where('service_time', $request->service_time);
        }

        if ($request->department_id != null) {
            $result = $result->where('department_id', $request->department_id);

        }

        //check client id
        CommonRepository::checkClientId($result);

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}
