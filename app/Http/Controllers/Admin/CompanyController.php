<?php

namespace App\Http\Controllers\Admin;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyDtails;
use App\Models\State;
use App\Models\City;
use App\Models\District;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use App\Http\Resources\Admin\Company\CompanyCollection;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    if ($request->wantsJson()) {
       
        $datas = Company::orderBy('admins.created_at', 'desc')
    ->where('admins.role_id', 3) // Filter where role_id is 3
    ->whereNotIn('admins.id', [1]) // Exclude admins with id 1
    ->join('roles', 'roles.id', '=', 'admins.role_id') // Join with roles table
    ->select([
        'admins.id as id', 
        'roles.name as role', 
        'admins.name as name', 
        'admins.mobile as mobile',
        'email', 
        'admins.status'
    ]);

        $request->merge(['recordsTotal' => $datas->count(), 'length' => $request->length]);
        $datas = $datas->limit($request->length)->offset($request->start)->get();
        return response()->json(new CompanyCollection($datas));
        // dd($datas);
    }
    
    return view('admin.company.list');
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereNotIn('id',[1])->select(['id','name'])->get()->pluck('name','id')->toArray();
        // dd($roles);
        $state=State::all();
        // dd($state);
        return view('admin.company.create', compact('roles','state'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'company_name' => 'required|string|max:255|unique:admins,name',
        'email' => 'required|email|max:255|unique:admins,email',
        'contact_no' => 'required|string|max:20|regex:/^\d{10}$/',
        'type' => 'required|string|max:255',
        'owner_name' => 'required|string|max:255',
        'address' => 'required|string',
       'city' => 'required|exists:city,id',      
        'distt' => 'required|exists:district,id',   
        'state' => 'required|exists:state,id', 
        'gst_no' => 'required|string|max:255|unique:admin_details,gst_no',
        'pan_no' => 'required|string|max:255|unique:admin_details,pan_no',
        'aadhar_no' => 'required|string|max:255|unique:admin_details,aadhar_no',
        'udyam_no' => 'nullable|string|max:255',
        'cin_no' => 'nullable|string|max:255',
        'epf_no' => 'nullable|string|max:255',
        'esic_no' => 'nullable|string|max:255',
        'bank_name' => 'required|string|max:255',
        'ac_no' => 'required|string|max:255',
        'ifs_code' => 'required|string|max:255',
    ]);
    // dd($validatedData);
    DB::beginTransaction();

    try {
        // Create the company
        $admin = new Company();
        $admin->name = $request->input('company_name');
        $admin->email = $request->input('email');
        $admin->mobile = $request->input('contact_no');
        $admin->save();
        // Create company details
        $adminDetail = new CompanyDtails();
        $adminDetail->admin_id = $admin->id;
        $adminDetail->type = $request->input('type');
        $adminDetail->owner_name = $request->input('owner_name');
        $adminDetail->address = $request->input('address');
        $adminDetail->city_id = $request->input('city');
        $adminDetail->district_id = $request->input('distt');
        $adminDetail->state_id = $request->input('state');
        $adminDetail->gst_no = $request->input('gst_no');
        $adminDetail->pan_no = $request->input('pan_no');
        $adminDetail->aadhar_no = $request->input('aadhar_no');
        $adminDetail->udyam_no = $request->input('udyam_no');
        $adminDetail->cin_no = $request->input('cin_no');
        $adminDetail->epf_no = $request->input('epf_no');
        $adminDetail->esic_no = $request->input('esic_no');
        $adminDetail->bank_name = $request->input('bank_name');
        $adminDetail->ac_no = $request->input('ac_no');
        $adminDetail->ifs_code = $request->input('ifs_code');
        $adminDetail->save();
        DB::commit();
        return redirect()->back()->with(['class'=>'success', 'message'=>'Company Created successfully.']);

    } catch (\Exception $e) {
        DB::rollBack();
        // dd($e->getMessage(), $e->getTrace());
        return redirect()->back()->with(['class'=>'danger', 'message'=>'Failed to create Company. Please try again later.']);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $admin = Company::findOrFail($id);
    $adminDetail = CompanyDtails::where('admin_id', $admin->id)->first();
    return view('admin.company.view',compact('admin', 'adminDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::with(['details.city', 'details.state', 'details.district'])
                   ->find($id);
                   $states = State::pluck('state_title', 'id')->toArray();
                   $city = City::pluck('name', 'id')->toArray(); 
                //    dd($city);

                   $district = District::pluck('district_title', 'id')->toArray(); 
        return view('admin.company.edit',compact('company','states','city','district'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'company_name' => 'required|string|max:255|unique:admins,name,' . $id,
        'email' => 'required|email|max:255|unique:admins,email,' . $id,
        'contact_no' => 'required|string|max:20|regex:/^\d{10}$/',
        'type' => 'required|string|max:255',
        'owner_name' => 'required|string|max:255',
        'address' => 'required|string',
        'city' => 'required|exists:city,id',      
        'distt' => 'required|exists:district,id',   
        'state' => 'required|exists:state,id',
        'gst_no' => 'required|string|max:255',
        'pan_no' => 'required|string|max:255',
        'aadhar_no' => 'required|string|max:255',
        'udyam_no' => 'nullable|string|max:255',
        'cin_no' => 'nullable|string|max:255',
        'epf_no' => 'nullable|string|max:255',
        'esic_no' => 'nullable|string|max:255',
        'bank_name' => 'required|string|max:255',
        'ac_no' => 'required|string|max:255',
        'ifs_code' => 'required|string|max:255',
    ]);
    DB::beginTransaction();

    try {
        // Update the company
        $admin = Company::findOrFail($id);
        $admin->name = $request->input('company_name');
        $admin->email = $request->input('email');
        $admin->mobile = $request->input('contact_no');
        $admin->save();

        // Update company details
        $adminDetail = CompanyDtails::where('admin_id', $id)->first();
        if (!$adminDetail) {
            $adminDetail = new CompanyDtails();
            $adminDetail->admin_id = $id;
        }
        
        $adminDetail->type = $request->input('type');
        $adminDetail->owner_name = $request->input('owner_name');
        $adminDetail->address = $request->input('address');
        $adminDetail->city_id = $request->input('city');
        $adminDetail->district_id = $request->input('distt');
        $adminDetail->state_id = $request->input('state');
        $adminDetail->gst_no = $request->input('gst_no');
        $adminDetail->pan_no = $request->input('pan_no');
        $adminDetail->aadhar_no = $request->input('aadhar_no');
        $adminDetail->udyam_no = $request->input('udyam_no');
        $adminDetail->cin_no = $request->input('cin_no');
        $adminDetail->epf_no = $request->input('epf_no');
        $adminDetail->esic_no = $request->input('esic_no');
        $adminDetail->bank_name = $request->input('bank_name');
        $adminDetail->ac_no = $request->input('ac_no');
        $adminDetail->ifs_code = $request->input('ifs_code');
        $adminDetail->save();
        DB::commit();

        return redirect()->back()->with(['class'=>'success', 'message'=>'Company updated successfully.']);

    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->back()->with(['class'=>'danger', 'message'=>'Failed to update company. Please try again later.']);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
