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
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeeDetailsImport;
use App\Models\Tempemployeedetails;
use App\Models\Wage;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon; // Make sure Carbon is imported



class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
     
             // Example input
            
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
       $skills = Wage::where('is_active', 1)->get();


        return view('admin.employee.create',compact('companies','roles','state','skills'));
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
            'skill' => 'required',
            'location' => 'required|string|max:255',
            'city' => 'required|exists:city,id',      
            'distt' => 'required|exists:district,id',   
            'state' => 'required|exists:state,id', 
            
        ]);
        // dd($validatedData);
        DB::beginTransaction();

        try {
            $employee = Employee::create([
                'name' => $validatedData['employee_name'],
                'email'=> $validatedData['email'],
                'skillset'=>$validatedData['skill'],
                'mobile' => $validatedData['mobile'],
                'gender' => $validatedData['gender'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'company_id' => $validatedData['company_id'],
            ]);
            $employeeDetails = EmployeeDetails::create([
                'admin_id' => $employee->id,  
                'father_or_husband_name' => $validatedData['father_or_husband_name'],
                'aadhar_no' => $validatedData['aadhar_no'],
                'ac_no' => $validatedData['bank_account_no'],
                'bank_name' => $validatedData['bank_name'],
                'ifs_code' => $validatedData['ifsc_code'],
                'esic_no' => $validatedData['esic_no'],
                'epf_no' => $validatedData['pf_no'],
                'date_of_joining' => $validatedData['date_of_joining'],
                'location' => $validatedData['location'],
                'city_id'=>$validatedData['city'],
                'state_id'=>$validatedData['state'],
                'district_id'=>$validatedData['distt'],
            ]);
            DB::commit();
            return redirect()->back()->with(['class' => 'success', 'message' => 'Employee created successfully.']);
    
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating employee: ' . $e->getMessage());
           
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Failed to create employee. Please try again later.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with('company')->findOrFail($id);
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
            Log::error('Error updating employee: ' . $e->getMessage());
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Failed to update employee. Please try again later.']);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Employee=Employee::find($id);
        $Employee->delete();
        return redirect()->json()->with(['class' => 'success', 'message' => 'Employee deleted successfully.']);
       
    }
   
    public function salary($id)
    {
        $salary = EmployeeSalary::where('admin_id', $id)->first();
        if (!$salary) {
            $salary = new EmployeeSalary();
        }
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
            ['admin_id' => $employee->id], 
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
        return redirect()->back()->with(['class' => 'success', 'message' => 'Salary details updated successfully.']);
    }
    public function import(){
        $companies = Company::where('entity_type', 'company')->get();
        return view('admin.employee.import', compact('companies'));
    }

    public function storeimport(Request $request){
        $request->validate([
        'company_id' => 'required|exists:admins,id',
        'company_excel' => 'required|file|mimes:xlsx,xls,csv',
    ]);

        if ($request->hasFile('company_excel')) {
            $file = $request->file('company_excel');

            try {
                TempEmployeeDetails::truncate();
                Excel::import(new EmployeeDetailsImport($request->company_id), $file);
                return redirect()->route('admin.employee.uploaded_data.excell', ['employee' => $request->company_id])->with(['class' => 'success', 'message' => 'Company data imported successfully.']);
            } catch (\Exception $e) {
                dd($e);
                return redirect()->back()->with(['class' => 'danger', 'message' => 'Failed to import Employee data. Please try again later.']);
            }
        }

        return redirect()->back()->with(['class' => 'danger', 'message' => 'No file was uploaded.']);
  
    }
    public function showUploadedData( $employee)
    {
            $employees = TempEmployeeDetails::where('company_id', $employee)->get();
        $aadharCounts = $employees->groupBy('aadhar_no')->map(function ($group) {
            return $group->count();
        });
        $repeatedAadhars = $aadharCounts->filter(function ($count) {
            return $count > 1; 
        });
        $aadharNos = $employees->pluck('aadhar_no')->toArray();
        $existingAadhars = EmployeeDetails::whereIn('aadhar_no', $aadharNos)->pluck('aadhar_no')->toArray();
        return view('admin.employee.uploadview', compact('employees', 'repeatedAadhars', 'existingAadhars','employee'));
    }

   


    public function verify(Request $request)
    {
        $company_id = $request->input('company_id');
        $employeeData = TempEmployeeDetails::where('company_id', $company_id)->get();
    
        foreach ($employeeData as $employee) {
            try {
                // dd($employee);
                // Check for existing Aadhar number
                $existingEmployee = EmployeeDetails::where('aadhar_no', $employee['aadhar_no'])->first();
                if ($existingEmployee) {
                    continue; // Skip if employee already exists
                }
        
                // Check for duplicates in the current upload
                $isRepeated = Employee::where('company_id', $company_id)
                    ->where('email', $employee['email'])
                    ->count() > 1;
                if ($isRepeated) {
                    continue; // Skip repeated records
                }
        
                // Get state and district IDs
                $state_id = getStateId($employee['state']);
                $district_id = getDistrictId($employee['district'], $state_id);
                // You can call `getCityId()` here if city logic is implemented
                
                // Prepare date fields using Carbon
                $date_of_birth = $this->parseDate($employee['date_of_birth'], 'd/m/Y');  // Adjust format if needed
                $date_of_joining = $this->parseDate($employee['date_of_joining'], 'd/m/Y'); // Adjust format if needed
                $date_of_relieving = $employee['date_of_relieving'] !== 'N/A' 
                                    ? $this->parseDate($employee['date_of_relieving'], 'd/m/Y') // Adjust format if needed
                                    : null;
    
                // Create and save Employee instance
                $newEmployee = new Employee();
                $newEmployee->name = $employee['employee_name'];
                $newEmployee->email = $employee['email'];
                $newEmployee->mobile = $employee['mobile'];
                $newEmployee->gender = $employee['gender'];
                $newEmployee->date_of_birth = $date_of_birth;
                $newEmployee->company_id = $company_id;
                $newEmployee->skillset = $employee['skill_level'];
                $newEmployee->save();
                
                // Create and save EmployeeDetails instance
                $newEmployeeDetails = new EmployeeDetails();
                $newEmployeeDetails->admin_id = $newEmployee->id;
                $newEmployeeDetails->father_or_husband_name = $employee['father_or_husband_name'];
                $newEmployeeDetails->aadhar_no = $employee['aadhar_no'];
                $newEmployeeDetails->ac_no = $employee['bank_account_no'];
                $newEmployeeDetails->bank_name = $employee['bank_name'];
                $newEmployeeDetails->ifs_code = $employee['ifsc_code'];
                $newEmployeeDetails->esic_no = $employee['esic_no'];
                $newEmployeeDetails->epf_no = $employee['pf_no'];
                $newEmployeeDetails->date_of_joining = $date_of_joining;
                $newEmployeeDetails->date_of_relieving = $date_of_relieving;
                $newEmployeeDetails->location = $employee['location'];
                $newEmployeeDetails->nationality = $employee['nationality'];
                $newEmployeeDetails->state_id = $state_id;
                $newEmployeeDetails->basic = $employee['basic'];
                $newEmployeeDetails->designation =  $employee['designation'];
                $newEmployeeDetails->pf_basic = $employee['pf_basic'];
                $newEmployeeDetails->hra = $employee['hra'];
                $newEmployeeDetails->allowance = $employee['allowance'];
                $newEmployeeDetails->lwf = $employee['lwf'];
                $newEmployeeDetails->deduction = $employee['deduction'];
                $newEmployeeDetails->conveyance = $employee['conveyance'];

                


                // $newEmployeeDetails->city_id = getCityId($employee['city'], $district_id); // Assuming you have this function implemented
                
                // Save EmployeeDetails instance
                $newEmployeeDetails->save();
                
            } catch (\Exception $e) {
                // Log the error and skip to the next employee
                dd($e);
                Log::error('Error processing employee: ' . json_encode($employee) . ' Error: ' . $e->getMessage());
                continue;
            }
        }
    
        // Truncate TempEmployeeDetails after processing
        TempEmployeeDetails::truncate();
    
        return redirect()->route('admin.employee.index')->with('success', 'Employee data verified and saved successfully.');
    }
    private function parseDate($date, $format)
{
    try {
        return Carbon::createFromFormat($format, $date);
    } catch (\Exception $e) {
        Log::error('Invalid date format: ' . $date . ' Expected format: ' . $format);
        return null; // Return null if the format is incorrect
    }
}
    
}




