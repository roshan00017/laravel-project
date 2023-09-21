<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\MasterSettings\District;
use App\Models\MasterSettings\LocalBody;
use App\Models\MasterSettings\Province;
use Exception;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use function response;
use function setName;
use function trans;

class LocationController extends Controller
{
    public function getProvince()
    {
        try {
            $name = setName();
            $perProvinceCode = $_POST['per_province_code'] ?? 0;
            $isSameAddress = $_POST['is_same_address'] ?? 'no';
            $provinceList = Province::select('id', 'code', $name)
                ->where('status', '1')
                ->get();
            $result = '';
            foreach ($provinceList as $value) {
                if ($perProvinceCode == $value->code) {
                    $result .= "<option class='f-kalimati' value='".$value->code."' selected>".$value->$name.'</option>';
                } else {
                    $result .= "<option class='f-kalimati' value='".$value->code."'>".$value->$name.'</option>';
                }
            }

            return $result;
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function getDistrict(): string
    {
        try {
            $name = setName();
            $province_code = $_POST['province_code'];
            $perDistrictCode = $_POST['per_district_code'] ?? 0;
            $districtList = District::query()
                ->select('id', 'code', $name)
                ->where(['province_code' => $province_code, 'status' => true])
                ->orderBy($name)
                ->get();
            $result = "<option class='f-kalimati' value=''>".trans('message.pages.common.select_district_name').'</option>';
            foreach ($districtList as $value) {
                if ($perDistrictCode == $value->code) {
                    return "<option class='f-kalimati' value='".$value->code."' selected>".$value->$name.'</option>';
                } else {
                    $result .= "<option class='f-kalimati' value='".$value->code."'>".$value->$name.'</option>';
                }
            }

            return $result;
        } catch (Exception $e) {

            return response()->json([
                'success' => false,
                'data' => [],
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function getLocalBody(): string
    {
        try {
            $name = setName();
            $district_code = $_POST['district_code'];
            $perLocalBodyCode = $_POST['per_local_body_code'] ?? 0;
            $localBody = LocalBody::query()
                ->select('id', 'code', $name)
                ->where(['district_code' => $district_code, 'status' => true])
                ->orderBy($name)
                ->get();
            $result = "<option class='f-kalimati' value=''>".trans('message.pages.common.select_local_body_name').'</option>';
            foreach ($localBody as $value) {
                if ($perLocalBodyCode == $value->code) {
                    $result = "<option class='f-kalimati' value='".$value->code."' selected>".$value->$name.'</option>';
                } else {
                    $result .= "<option class='f-kalimati' value='".$value->code."'>".$value->$name.'</option>';
                }
            }

            return $result;
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function getWard(): string
    {
        try {
            $local_body_code = $_POST['local_body_code'];
            //            $perWard = $_POST['per_ward'] ?? '';
            $perWard = explode('-', $_POST['per_ward'] ?? '')[0];
            $localBodyInfo = LocalBody::query()
                ->where(['code' => $local_body_code, 'status' => true])
                ->first();
            $ward_list = range(1, $localBodyInfo->total_ward);
            $result = "<option class='f-kalimati' value=''>".trans('common.select_ward_no').'</option>';
            foreach ($ward_list as $value) {
                if (trim($perWard) == trim($value)) {
                    $result .= "<option class='f-kalimati' value='".$value."' selected>".$value.'</option>';
                } else {
                    // $result .= "<option class='f-kalimati' value='" . $value . "'>" . $value  . "</option>";
                    $result .= "<option class='f-kalimati' value='".$value."'>".$value.'</option>';
                }
            }

            return $result;
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }

    public function isCopyLocationInfo()
    {
        try {
            $name = setName();
            $code = $_POST['code'];
            $type = Str::lower($_POST['type']);
            $result = '';
            if ($type == 'province') {
                $result = Province::query()->where('code', $code)->select('id', 'code', $name.' '.'as name')->first();
            } elseif ($type == 'district') {
                $result = District::query()->where('code', $code)->select('id', 'code', $name.' '.'as name')->first();
            } elseif ($type == 'local_body') {
                $result = LocalBody::query()->where('code', $code)->select('id', 'code', $name.' '.'as name')->first();
            }

            return [
                'code' => $result->code,
                'name' => $result->name,
            ];
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => Lang::get('message.commons.technicalError'),
            ], 500);
        }
    }
}
