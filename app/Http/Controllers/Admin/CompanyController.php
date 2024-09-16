<?php

namespace App\Http\Controllers\Admin;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyDtails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::whereNotIn('id',[1])->select(['id','name'])->get()->pluck('name','id')->toArray();
        // dd($roles);
        return view('admin.company.create', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::whereNotIn('id',[1])->select(['id','name'])->get()->pluck('name','id')->toArray();
        // dd($roles);
        return view('admin.company.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        $validatedData=$request->validate([
            'role' => 'required|exists:roles,id',
            'company_name' => 'required|string|max:255|unique:admins,name',
            'email' => 'required|email|max:255|unique:admins,email',
            'contact_no' => 'required|string|max:20|regex:/^\d{10}$/',
            'type' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'distt' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'gst_no' => 'required',
            'pan_no' => 'required',
            'aadhar_no' => 'required',
            'udyam_no' => 'nullable|string|max:255',
            'cin_no' => 'nullable|string|max:255',
            'epf_no' => 'nullable|string|max:255',
            'esic_no' => 'nullable|string|max:255',
            'bank_name' => 'required|string|max:255',
            'ac_no' => 'required|string|max:255',
            'ifs_code' => 'required|string|max:255',
        ]);
       
        $admin = new Company();
        // dd($admin);
        $admin->role_id = $request->input('role');
        $admin->name = $request->input('company_name');
        $admin->email = $request->input('email');
        $admin->mobile = $request->input('contact_no');
        $admin->save();
       
        // Create a new AdminDetail record
        $adminDetail = new CompanyDtails();
        $adminDetail->admin_id = $admin->id;
        $adminDetail->type = $request->input('type');
        $adminDetail->owner_name = $request->input('owner_name');
        $adminDetail->address = $request->input('address');
        $adminDetail->city = $request->input('city');
        $adminDetail->distt = $request->input('distt');
        $adminDetail->state = $request->input('state');
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
        return redirect()->back()->with(['class'=>'success','message'=>'Company Created successfully.']);

     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
