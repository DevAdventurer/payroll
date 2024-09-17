<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Wallet;
use App\Rules\GSTNumber;
use App\Rules\MobileNumber;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Http\Resources\Admin\Admin\AdminCollection;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            //dd($request->all());
            $datas = Admin::orderBy('admins.created_at','desc')
            ->with(['role', 'media']);

            $request->merge(['recordsTotal' => $datas->count(), 'length' => $request->length]);
            $datas = $datas->limit($request->length)->offset($request->start)->get();

            return response()->json(new AdminCollection($datas));

        }
        return view('admin.admin.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
        $roles = Role::whereNotIn('id',[1])->select(['id','name'])->get()->pluck('name','id')->toArray();
        return view('admin.admin.create',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, admin $admin )
    {
        $loginTimes = adminLogin::where('admin_id',$admin->id)->get();
        $policy = DB::table('role_policies')->where('role_id',$admin->role_id)->first();
        return view('admin.admin.view',compact('admin','loginTimes','policy'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request) {
            $array = ['primary', 'secondary', 'success', 'info', 'warning', 'danger'];
            $random = Arr::random($array);

            $this->validate($request,[
                'last_name'=>'required|string|max:255',
                'password'=>'required|string|min:6',
                'gender'=>'required',
                'status'=>'required',
                'role'=>'required',
                'email'=>'required|email|max:255|unique:admins',
                'first_name'=>'required|string|max:255',
                'address' => 'required|max:500',
                'company_name' => 'required|max:255',
                'locality' => 'required|max:255',
                'state' => 'required',
                'city' => 'required',
                'district' => 'required',
                'pincode' => 'required|integer|digits:6',
                'password'=>'required|string|min:6',
                'mobile_number' => ['required', new MobileNumber()],
            ]);

            $admin = new Admin;
            $admin->gender = $request->gender;
            $admin->role_id = $request->role;
            $admin->password = bcrypt($request->password);
            $admin->first_name = $request->first_name;
            $admin->last_name = $request->last_name;
            $admin->full_name = $request->first_name . " " .$request->last_name;
            $admin->name_init = Str::upper(Str::limit($request->first_name, 1,'').Str::limit($request->last_name, 1,''));
            $admin->email = $request->email;
            $admin->mobile = $request->mobile_number;
            $admin->address = $request->address;
            $admin->state_id = $request->state;
            $admin->city_id = $request->city;
            $admin->district_id = $request->district;
            $admin->pincode = $request->pincode;
            $admin->gst = $request->gst;
            $admin->company_name = $request->company_name;
            $admin->locality = $request->locality;
            $admin->status_id = $request->status;
            $admin->color = $random;

            if($request->has('logo')){
                foreach($request->logo as $file){
                    $admin->media_id = $file;
                }
            }

            if($admin->save()){
                $wallet = Wallet::firstOrNew(['admin_id' => $admin->id]);
                $wallet->amount = 0;
                $wallet->save();
                return redirect()->route('admin.admin.index')->with(['class'=>'success','message'=>'Admin Created successfully.']);
            }

            return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }


        public function edit(Request $request, $id ){
            $admin = Admin::find($id);
            return view('admin.admin.edit',compact('admin'));
        }






        public function update(Request $request, $id) {

            $this->validate($request,[
                'name'=>'required',
                'role'=>'required',
            ]);

            $admin = Admin::find($id);

            $admin->role_id = $request->role;
            $admin->name = $request->name;
            $admin->mobile = $request->contact_number;
            $admin->gender = $request->gender;
            $admin->status = $request->status??0;
            $admin->date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');
            if($request->password != '' || $request->password != null || $request->password != NULL || $request->password != Null){
                $admin->password = bcrypt($request->password);
            }

            if($request->hasFile('avatar')){
                $image_name = time().".".$request->file('avatar')->getClientOriginalExtension();
                $image = $request->file('avatar')->storeAs('admin', $image_name);
                $admin->avatar = 'storage/'.$image;
            }

            if($admin->save()){
                return redirect()->route('admin.admin.index', )->with(['class'=>'success','message'=>'Admin updated successfully.']);
            }

            return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }







         public function profileUpdate(Request $request) {

           // return $request->all();
            $this->validate($request,[
                'name'=>'required',
            ]);

            $admin = Auth::guard('admin')->user();

            $admin->name = $request->name;
            $admin->mobile = $request->mobile_no;
            $admin->gender = $request->gender;
            $admin->state = $request->state;
            $admin->city = $request->city;
            $admin->pincode = $request->zipcode;
            $admin->address = $request->address;
            $admin->bio = $request->bio;
            $admin->date_of_birth = Carbon::parse($request->date_of_birth)->format('Y-m-d');


            if($admin->save()){
                return response()->json(['message'=>'Profile  Updated', 'class'=>'success']);
            }

             return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...', 'class'=>'error']);
        }



    public function destroy(Request $request, Admin $admin)
    {

        if($admin->delete()){

            return response()->json(['message'=>'User deleted successfully ...', 'class'=>'success', 'error'=>false, 'title'=>'Item Deleted!', 'timer'=>2000]);

        }
        return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...', 'class'=>'error']);
    }




    public function profilePhotoUpdate(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'avatar'=>'required',   
        ]);

        $admin = Auth::guard('admin')->user();

       if($request->hasFile('avatar')){
            $image_name = time().".".$request->file('avatar')->getClientOriginalExtension();
            $image = $request->file('avatar')->storeAs('media/admin', $image_name);
            $storage_type = env('FILESYSTEM_DISK');
            if($storage_type == 's3'){
                $admin->avatar = config('appsetting.media_url').$image;
            }else{
                $admin->avatar = 'storage/'.$image;
            }
            //$admin->avatar = 'storage/'.$image;
        }

        if($admin->save()){ 
            return response()->json(['message'=>'Profile Photo Updated', 'class'=>'success']);
        }

        return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...', 'class'=>'error']);
    }


    public function profileCoverPhotoUpdate(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'cover_photo'=>'required',   
        ]);

        $admin = Auth::guard('admin')->user();

       if($request->hasFile('cover_photo')){
            $image_name = time().".".$request->file('cover_photo')->getClientOriginalExtension();
            $image = $request->file('cover_photo')->storeAs('media/admin', $image_name);
            $storage_type = env('FILESYSTEM_DISK');
            if($storage_type == 's3'){
                $admin->cover_photo = config('appsetting.media_url').$image;
            }else{
                $admin->cover_photo = 'storage/'.$image;
            }
        }

        if($admin->save()){ 
            return response()->json(['message'=>'Profile Photo Updated', 'class'=>'success']);
        }

        return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...', 'class'=>'error']);
    }






    public function updatePassword(Request $request)
    {
       // return $request->all();
        $this->validate($request,[
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6|confirmed',

        ]);

        if(Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {
            $admin = Auth::guard('admin')->user();
            $admin->password = bcrypt($request->new_password);
            if($admin->save()){
                return response()->json(['message'=>'Password changed successfully.', 'class'=>'success']);
                //return redirect()->route('admin.admin.profile', $admin->id)->with(['class'=>'success','message'=>'Password changed successfully.']);
            }
            return response()->json(['message'=>'Whoops, looks like something went wrong ! Try again ...', 'class'=>'error']);
            //return redirect()->back()->with(['message'=>'Whoops, looks like something went wrong ! Try again ...','class'=>'danger']);
        }
        return response()->json(['message'=>'Old Password is not match', 'class'=>'error']);
        //return redirect()->back()->with(['message'=>'Current Password is not match','class'=>'error']);
    }




    public function profile(Request $request)
    {
        //return $request->all();
        $admin = Auth::guard('admin')->user();
        return view('admin.admin.profile', compact('admin'));
    }


    public function changePassword(Request $request, $id)
    {
        return view('admin.admin.change-password');
    }
}
