<?php

namespace App\Http\Controllers\Grevience;

use App\Http\Controllers\Controller;
use App\Models\MasterSettings\District;
use App\Models\MasterSettings\LocalBody;
use App\Models\MasterSettings\Province;
use App\Models\MstFederalHierarchy;
use App\Models\MstLocationHierarchy;
use DB;
use Illuminate\Support\Facades\Request;

class DropDownController extends Controller
{
    // public static function getZone()
    // {
    //     return MstLocationHierarchy::where('location_type_id', 3)->where(['status' => true, 'is_deleted' => false, 'client_id' => 1])->get();
    // }

    public static function getProvinceList()
    {
        return Province::get();
    }

    public static function getAllDistricts()
    {
        return District::get();
    }

    public static function getAllVdcMun()
    {
        return LocalBody::get();
    }

    // MstLocationHierarchy::where('location_type_id', 4)->where(array('status' => true, 'is_deleted' => false,'client_id' => 1))->get();

    // DB::table('mst_location_hierarchy')
    //                 ->distinct()
    //                 ->select('mst_location_hierarchy.id', 'mst_location_hierarchy.code', 'mst_location_hierarchy.name_np', 'mst_location_hierarchy.name_en')
    //                 ->where('mst_location_hierarchy.client_id',1)
    //                 ->whereIn('mst_location_hierarchy.location_type_id', [5, 6, 7, 8])
    //                 ->get();

    public function getzonaldistrict($id)
    {
        return MstLocationHierarchy::where('parent_id', $id)->get();
    }

    public function getzonalvdc($id)
    {
        $local_level = MstLocationHierarchy::where('parent_id', $id)->get();

        return response()->json($local_level);
    }

    public function getfed_district($id)
    {

        $district = District::where(['province_code' => $id])->get();

        return response()->json($district);

    }

    public function getfed_vdc($id)
    {
        $local_level = MstFederalHierarchy::where(['is_deleted' => false, 'federal_level_type_id' => 3, 'parent_id' => $id])->get();

        return response()->json($local_level);
    }

    public function get_fed_district(Request $request)
    {
        $province_id = $request->input('province_code');
        $districts = District::distinct()
            ->select('district.name_np')
            ->where('province_code', $province_id)
            ->get();

        return $districts;
    }

    public function get_fed_vdc_mun()
    {
        $district_id = $_POST['district_id'];
        $vdc_munList = LocalBody::distinct()
            ->select('local_bodies.name_np')
            ->where(['local_bodies.district_code' => $district_id])
            ->get();

        return $vdc_munList;
    }
}
