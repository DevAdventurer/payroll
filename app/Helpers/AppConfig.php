<?php 
use App\Models\State;
use App\Models\District;
use App\Models\City;




if (! function_exists('short_description')) {
    function short_description($str) {
            $description = substr($str, 0, 10);
            return $description;
    }
}




if(!function_exists('get_app_setting')){
    function get_app_setting($setting_type){
        $setting = App\Models\SiteSetting::with(['siteLogo','siteFavicon'])->latest()->first();
        if($setting[$setting_type]){

            if($setting_type == 'logo' && $setting->siteLogo){
                return $setting->siteLogo->file;
            }
            if($setting_type == 'favicon' && $setting->siteFavicon){
                return $setting->siteFavicon->file;
            }

            return $setting[$setting_type];
        }
        return "Undefined request";
    }
}

if (!function_exists('getAdmin')) {
    function getAdmin($get_detail){
        $admin = \Auth::guard('admin')->user();

        if($get_detail != 'password' && $get_detail != 'role' && $get_detail != 'role_id'){
            if($admin[$get_detail]){
                return $admin[$get_detail];
            }
        }

        if ($get_detail == 'role') {
            $admin->with('role')->first();
            return $admin->role->display_name;
        }
        
        return "Undefined request";
    }
}

 function getStateId($statename)
{
   
    $states = State::all();
   
    $bestMatch = null;
    $bestSimilarity = 0;

    foreach ($states as $state) {
        similar_text(strtolower($statename), strtolower($state->state_title), $percent);
        if ($percent > $bestSimilarity) {
            $bestSimilarity = $percent;
            $bestMatch = $state;
        }
    }
  
    return $bestSimilarity >= 75 ? $bestMatch->id : null;
}

if (!function_exists('getDistrictId')) {
    function getDistrictId($districtName, $stateId)
    {
        // Get districts filtered by state_id
        $districts = District::where('state_id', $stateId)->get();

        $bestMatch = null;
        $bestSimilarity = 0;

        foreach ($districts as $district) {
            similar_text(strtolower($districtName), strtolower($district->district_title), $percent);
            if ($percent > $bestSimilarity) {
                $bestSimilarity = $percent;
                $bestMatch = $district;
            }
        }

        return $bestSimilarity >= 75 ? $bestMatch->id : null;
    }
}


if (!function_exists('getCityId')) {
    function getCityId($cityName, $districtId)
    {
        // Get cities filtered by district_id
        $cities = City::where('districtid', $districtId)->get();

        $bestMatch = null;
        $bestSimilarity = 0;

        foreach ($cities as $city) {
            similar_text(strtolower($cityName), strtolower($city->city_title), $percent);
            if ($percent > $bestSimilarity) {
                $bestSimilarity = $percent;
                $bestMatch = $city;
            }
        }

        return $bestSimilarity >= 75 ? $bestMatch->id : null;
    }
}



