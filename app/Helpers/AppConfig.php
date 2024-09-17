<?php 

use App\Models\Admin;

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
    function getAdmin($get_detail) {
        $admin = \Auth::guard('admin')->user();
        if (!$admin) {
            return "No admin is currently logged in";
        }
        if (!in_array($get_detail, ['password', 'role', 'role_id'])) {
            if (isset($admin[$get_detail])) {
                return $admin[$get_detail];
            }
        }
        if ($get_detail == 'role') {
            $admin = $admin->load('role'); 
            if ($admin->role) {
                return $admin->role->display_name;
            }
            return "Role not found";
        }

        if ($get_detail == 'role_id') {
            return $admin->role_id ?? "Role ID not found";
        }

        return "Undefined request";
    }
}

if (!function_exists('status')) {

    function status($id){
        $weight = App\Models\Status::where(['id'=> $id])->first();
        if($weight){
            return $weight->status_badge;
        }
        return null;
    }
}


if (!function_exists('userName')) {
    function userName($id){
        $client = Admin::find($id);
        $id = $client->id .'1a';

        if($client->role_id == 3){
            $nameClass = '';
            $companyClass = 'text-success';
        }
        elseif($client->role_id == 4){
            $nameClass = '';
            $companyClass = 'text-secondary';
        }
        else{
            $nameClass = '';
            $companyClass = 'text-muted';
        }

        if($client->media){
            return '<div class="d-flex align-items-center">
                <div class="avatar-group-item material-shadow">
                    <div class="flex-shrink-0 avatar-sm me-3 bg-light rounded-circle" style="position:relative; overflow: hidden;">
                        '. getFile($client->media->file, $id) .'
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div>
                        <h5 class="mb-1 fs-14 '.$nameClass.'">'.$client->first_name .' '. $client->last_name .'</h5>
                        <p class="mb-0 fs-13 '.$companyClass.'">'. $client->company_name .'</p>
                    </div>
                </div>
            </div>';
        } else{
            return '<div class="d-flex align-items-center">
                <div class="flex-shrink-0 rounded-circle bg-light '.$nameClass.' material-shadow avatar-sm me-3" style="position:relative; overflow: hidden;">
                    <span style="letter-spacing: 1px;position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; display: inline-table;">'. Str::upper(Str::limit($client->first_name, 1,'').Str::limit($client->last_name, 1,'')) .'</span>
                </div>
                <div class="flex-grow-1">
                    <div>
                        <h5 class="mb-1 fs-14 '.$nameClass.'">'.$client->first_name .' '. $client->last_name .'</h5>
                        <p class="mb-0 fs-13 '.$companyClass.'">'. $client->company_name .'</p>
                    </div>
                </div>
            </div>';
        }
    }

    if (!function_exists('getFile')) {
        function getFile($file, $id) {
            if ($file > 0){
                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
    
                if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                    return "<a style='line-height: 40px; width: 46px; display: block; padding: 2px;display: flex; justify-content: center; align-items: center; height: 100%;' class='glightbox' data-gallery='".$id."' href='".asset($file)."'>
                                <img class='img-fluid' src='".asset($file)."'/>
                            </a>";
                } elseif ($fileExtension == 'pdf') {
                    return "<a class='glightbox' data-gallery='".$id."' href='".asset($file)."'>
                                <img class='img-fluid' src='".asset('icons/pdf.png')."'/>
                            </a>";
                }
            }
            return "N/A";
        }
    }
}


