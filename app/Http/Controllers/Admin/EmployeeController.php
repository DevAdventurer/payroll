<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use App\Models\Role;
use App\Models\EmployeeDetails;
use App\Http\Resources\Admin\Employee\EmployeeCollection;
use Illuminate\Support\Facades\DB;
use App\Models\State;
use App\Models\City;
use App\Models\District;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if ($request->wantsJson()) {
       
            $datas = Employee::with(['company' => function ($query) {
                $query->select('id', 'name'); 
            }])
            ->join('roles', 'roles.id', '=', 'admins.role_id')
            ->orderBy('admins.created_at', 'desc')
            ->whereNotNull('admins.company_id') 
            ->select([
                'admins.id as id',
                'roles.name as role',
                'admins.name as name',
                'admins.mobile as mobile',
                'admins.email as email',
                'admins.status',
                'admins.company_id',
                
            ]);
        
        $request->merge(['recordsTotal' => $datas->count(), 'length' => $request->length]);
        $datas = $datas->limit($request->length)->offset($request->start)->get();
        return response()->json(new EmployeeCollection($datas));
        
        }
        return view('admin.employee.list');
   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies=Company::where('role_id',3)->get();
       $roles = Role::whereNotIn('id', [1, 2, 3])->get();
       $state=State::all();
        return view('admin.employee.create',compact('companies','roles','state'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'company_id' => 'required|exists:admins,id',
            'employee_name' => 'required|string|max:255',
            'father_or_husband_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email',
            'gender' => 'required|string|in:Male,Female,Other',
            'aadhar_no' => 'required|string|max:12',
            'mobile' => 'required|string|max:15',
            'bank_account_no' => 'required|string|max:20',
            'bank_name' => 'required|string|max:255',
            'ifsc_code' => 'required|string|max:11',
            'esic_no' => 'nullable|string|max:20',
            'pf_no' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'required|date',
            'date_of_relieving' => 'nullable|date',
            'location' => 'required|string|max:255',
            'city' => 'required|exists:city,id',      
            'distt' => 'required|exists:district,id',   
            'state' => 'required|exists:state,id', 
            'nationality' => 'required|string|max:255',
        ]);
    
        DB::beginTransaction();

        try {
            $employee = Employee::create([
                'name' => $validatedData['employee_name'],
                'email'=>'abc@gmail.com',
                'mobile' => $validatedData['mobile'],
                'gender' => $validatedData['gender'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'company_id' => $validatedData['company_id'],
            ]);
            // $adminDetail->city_id = $request->input('city');
            // $adminDetail->district_id = $request->input('distt');
            // $adminDetail->state_id = $request->input('state');
            $employeeDetails = EmployeeDetails::create([
                'admin_id' => $employee->id,  
                'father_or_husband_name' => $validatedData['father_or_husband_name'],
                'email' => $validatedData['email'],
                'aadhar_no' => $validatedData['aadhar_no'],
                'ac_no' => $validatedData['bank_account_no'],
                'bank_name' => $validatedData['bank_name'],
                'ifs_code' => $validatedData['ifsc_code'],
                'esic_no' => $validatedData['esic_no'],
                'epf_no' => $validatedData['pf_no'],
                'date_of_joining' => $validatedData['date_of_joining'],
                'date_of_relieving' => $validatedData['date_of_relieving'],
                'location' => $validatedData['location'],
                'city_id'=>$validatedData['city'],
                'state_id'=>$validatedData['state'],
                'district_id'=>$validatedData['distt'],
                'nationality' => $validatedData['nationality'],
            ]);
            DB::commit();
            return redirect()->back()->with(['class' => 'success', 'message' => 'Employee created successfully.']);
    
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('Error creating employee: ' . $e->getMessage());
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Failed to create employee. Please try again later.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with('company')->findOrFail($id);
        // dd($employee);
        $employeeDetails = EmployeeDetails::where('admin_id', $employee->id)->first();
        return view('admin.employee.view',compact('employee', 'employeeDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::with('company','employeedetail.city','employeedetail.state','employeedetail.district')->find($id);
        // dd($employee);
        $companies=Company::where('role_id',3)->get();
       $roles = Role::whereNotIn('id', [1, 2, 3])->get();
       $states = State::pluck('state_title', 'id')->toArray();
       $city = City::pluck('name', 'id')->toArray(); 
    //    dd($city);

       $district = District::pluck('district_title', 'id')->toArray(); 
        return view('admin.employee.edit',compact('employee','companies','roles','states','city','district'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'company_id' => 'required|exists:admins,id',
            'employee_name' => 'required|string|max:255',
            'father_or_husband_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $id, // Allow existing email for the current record
            'gender' => 'required|string|in:Male,Female,Other',
            'aadhar_no' => 'required|string|max:12',
            'mobile' => 'required|string|max:15',
            'bank_account_no' => 'required|string|max:20',
            'bank_name' => 'required|string|max:255',
            'ifsc_code' => 'required|string|max:11',
            'esic_no' => 'nullable|string|max:20',
            'pf_no' => 'nullable|string|max:20',
            'date_of_birth' => 'required|date',
            'date_of_joining' => 'required|date',
            'date_of_relieving' => 'nullable|date',
            'location' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'city' => 'required|exists:city,id',      
            'distt' => 'required|exists:district,id',   
            'state' => 'required|exists:state,id',
        ]);
    
        DB::beginTransaction();
    
        try {
            $employee = Employee::findOrFail($id);
            $employee->update([
                'name' => $validatedData['employee_name'],
                'email' => $validatedData['email'],
                'mobile' => $validatedData['mobile'],
                'gender' => $validatedData['gender'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'company_id' => $validatedData['company_id'],
            ]);
            $employeeDetails = EmployeeDetails::updateOrCreate(
                ['admin_id' => $id],  
                [
                    'father_or_husband_name' => $validatedData['father_or_husband_name'],
                    'email' => $validatedData['email'],
                    'aadhar_no' => $validatedData['aadhar_no'],
                    'ac_no' => $validatedData['bank_account_no'],
                    'district_id' => $validatedData['distt'],
                    'city_id' => $validatedData['city'],
                    'state_id' => $validatedData['state'],
                    'bank_name' => $validatedData['bank_name'],
                    'ifs_code' => $validatedData['ifsc_code'],
                    'esic_no' => $validatedData['esic_no'],
                    'epf_no' => $validatedData['pf_no'],
                    'date_of_joining' => $validatedData['date_of_joining'],
                    'date_of_relieving' => $validatedData['date_of_relieving'],
                    'location' => $validatedData['location'],
                    'nationality' => $validatedData['nationality'],
                ]
            );
            
            DB::commit();
            return redirect()->back()->with(['class' => 'success', 'message' => 'Employee updated successfully.']);
    
        } catch (Exception $e) {
            DB::rollBack();
            \Log::error('Error updating employee: ' . $e->getMessage());
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Failed to update employee. Please try again later.']);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
   
    public function salary($id)
    {
        // Retrieve the first salary record for the given admin_id
        $salary = EmployeeSalary::where('admin_id', $id)->first();
    
        // If no salary record exists, create a default empty instance (to prevent errors)
        if (!$salary) {
            $salary = new EmployeeSalary();
        }
    
        // Return the salary view with the salary data and admin id
        return view('admin.employee.salary', compact('salary', 'id'));
    }
    
    public function storesalary(Request $request, $id){
        $request->validate([
            'basic'      => 'required|numeric|min:0',
            'designation'      => 'required',
            'pf_basic'   => 'required|numeric|min:0',
            'hra'        => 'required|numeric|min:0',
            'allowance'  => 'required|numeric|min:0',
            'lwf'        => 'required|numeric|min:0',
            'deduction'  => 'required|in:PF,ESI,PF+ESI,PDST,NONE',
            'conveyance' => 'required|numeric|min:0',
        ]);
        $employee = Employee::findOrFail($id);
        EmployeeSalary::updateOrCreate(
            ['admin_id' => $employee->id], // Find the salary by admin_id or create new one
            [
                'basic'      => $request->input('basic'),
                'designation'      => $request->input('designation'),
                'pf_basic'   => $request->input('pf_basic'),
                'hra'        => $request->input('hra'),
                'allowance'  => $request->input('allowance'),
                'lwf'        => $request->input('lwf'),
                'deduction'  => $request->input('deduction'),
                'conveyance' => $request->input('conveyance')
            ]
        );

        // Redirect back with success message
        return redirect()->back()->with(['class' => 'success', 'message' => 'Salary details updated successfully.']);
    }
    public function import(){
        dd("hello");
        return view('admin.employee.import');
    }
    public function storeimport(Request $request){
        $request->validate([
            'company_excel' => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ]);

        if ($request->hasFile('company_excel')) {
            $file = $request->file('company_excel');

            try {
                Excel::import(new CompanyImport, $file);

                return redirect()->back()->with(['class' => 'success', 'message' => 'Company data imported successfully.']);
            } catch (\Exception $e) {
                return redirect()->back()->with(['class' => 'danger', 'message' => 'Failed to import company data. Please try again later.']);
            }
        }

        return redirect()->back()->with(['class' => 'danger', 'message' => 'No file was uploaded.']);
  
    }
}
