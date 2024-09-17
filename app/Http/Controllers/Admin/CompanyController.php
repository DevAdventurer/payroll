<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Company;
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
use App\Http\Resources\Admin\Company\CompanyCollection;

class CompanyController extends Controller
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
            $datas = Company::orderBy('created_at','desc')
            ->with(['city', 'media']);

            $request->merge(['recordsTotal' => $datas->count(), 'length' => $request->length]);
            $datas = $datas->limit($request->length)->offset($request->start)->get();

            return response()->json(new CompanyCollection($datas));

        }
        return view('admin.company.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request )
    {
        return view('admin.company.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $company = Company::find($id);
        return view('admin.company.view',compact('company'));
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

            $request->validate([
                'last_name'=>'required|string|max:255',
                'password'=>'required|string|min:6',
                'email'=>'required|email|max:255|unique:admins',
                'first_name'=>'required|string|max:255',
                'address' => 'required|max:500',
                'company_name' => 'required|max:255',
                'locality' => 'required|max:255',
                'state' => 'required',
                'city' => 'required',
                'district' => 'required',
                'pincode' => 'required|integer|digits:6',
                'gst' => ['required', new GSTNumber()],
                'mobile_number' => ['required', new MobileNumber()],
            ]);

            $company = new Company;
            $company->gender = 3;
            $company->password = bcrypt(123456);
            $company->first_name = $request->first_name;
            $company->last_name = $request->last_name;
            $company->full_name = $request->first_name . " " .$request->last_name;
            $company->name_init = Str::upper(Str::limit($request->first_name, 1,'').Str::limit($request->last_name, 1,''));
            $company->email = $request->email;
            $company->mobile = $request->mobile_number;

            $company->address = $request->address;
            $company->state_id = $request->state;
            $company->city_id = $request->city;
            $company->district_id = $request->district;
            $company->pincode = $request->pincode;
            $company->landmark = $request->landmark;
            $company->gst = $request->gst;
            $company->company_name = $request->company_name;

            $company->locality = $request->locality;
            $company->status_id = 12;
            $company->color = $random;

            if($request->has('logo')){
                foreach($request->logo as $file){
                    $company->media_id = $file;
                }
            }

            if($company->save()){
                return response()->json(['class' => 'bg-success', 'error' => false, 'message' => 'Company Saved Successfully', 'call_back' => route('admin.company.index')]);
            }

            return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }


        public function edit(Request $request, $id ){
            $company = Company::find($id);
            return view('admin.company.edit',compact('company'));
        }






        public function update(Request $request, $id) {
            $array = ['primary', 'secondary', 'success', 'info', 'warning', 'danger'];
            $random = Arr::random($array);

            $request->validate([
                'last_name'=>'required|string|max:255',
                'status'=>'required',
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('admins')->ignore($id) // Ignore the email uniqueness if it's an update
                ],
                'first_name'=>'required|string|max:255',
                'address' => 'required|max:500',
                'company_name' => 'required|max:255',
                'locality' => 'required|max:255',
                'state' => 'required',
                'city' => 'required',
                'district' => 'required',
                'pincode' => 'required|integer|digits:6',
                'gst' => ['nullable', new GSTNumber()],
                'mobile_number' => ['required', new MobileNumber()],
            ]);

            $company = Admin::find($id);
            $company->gender = 3;
            $company->password = bcrypt($request->password);
            $company->first_name = $request->first_name;
            $company->last_name = $request->last_name;
            $company->full_name = $request->first_name . " " .$request->last_name;
            $company->name_init = Str::upper(Str::limit($request->first_name, 1,'').Str::limit($request->last_name, 1,''));
            $company->email = $request->email;
            $company->mobile = $request->mobile_number;
            $company->address = $request->address;
            $company->state_id = $request->state;
            $company->city_id = $request->city;
            $company->district_id = $request->district;
            $company->pincode = $request->pincode;
            $company->gst = $request->gst;
            $company->company_name = $request->company_name;
            $company->locality = $request->locality;
            $company->landmark = $request->landmark;
            $company->status_id = $request->status;
            $company->color = $random;

            if($request->has('logo')){
                foreach($request->logo as $file){
                    $company->media_id = $file;
                }
            }
            if($company->save()){
                return response()->json(['class' => 'bg-success', 'error' => false, 'message' => 'Company Saved Successfully', 'call_back' => route('admin.company.index')]);
            }
            return redirect()->back()->with(['class'=>'error','message'=>'Whoops, looks like something went wrong ! Try again ...']);
        }

}
