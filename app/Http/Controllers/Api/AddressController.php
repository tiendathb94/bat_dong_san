<?php

namespace App\Http\Controllers\Api;

use App\Entities\District;
use App\Entities\Province;
use App\Entities\Ward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function getProvinces()
    {
        $provinces = Province::query()->select(['name', 'id']);

        return response()->json($provinces->get());
    }

    public function getDistrictsByProvince(Request $request)
    {
        $provinceId = $request->get('province_id');

        if ($provinceId < 1) {
            return response()->json(['error' => true, 'message' => 'Cần gửi lên province id'], 400);
        }

        $districts = District::query()->select(['name', 'id', 'province_id'])->where('province_id', '=', $provinceId);

        return response()->json($districts->get());
    }

    public function getWardsByDistrict(Request $request)
    {
        $districtId = $request->get('district_id');

        if ($districtId < 1) {
            return response()->json(['error' => true, 'message' => 'Cần gửi lên district id'], 400);
        }

        $wards = Ward::query()->select(['name', 'id', 'district_id'])->where('district_id', '=', $districtId);

        return response()->json($wards->get());
    }
}
