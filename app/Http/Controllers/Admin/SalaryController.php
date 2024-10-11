<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\TempMonthlySalary;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TempEmployeeSalaryDetailsImport;
use App\Models\MonthlySalaryDetail;
use Illuminate\Support\Facades\DB;
use App\Exports\SalaryExport;




class SalaryController extends Controller
{
    public function index(Request $request){
        $companies = Company::
        where('entity_type', 'company')
        ->pluck('name', 'id');
    
        $tempsalary=TempMonthlySalary::with('employee')->get();
        $notFoundAadhars = $request->session()->get('not_found_aadhars', []);
        return view('admin.salary.create',compact('companies','tempsalary','notFoundAadhars'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:admins,id',
            'wage_excel' => 'required|file|mimes:xlsx,xls,csv|max:2048',
            'year'=>'required',
            'month'=>'required',

        ]);
        DB::table('tempmonthlysalary')->truncate();

        $companyId = $request->input('company_id');
        $year = $request->input('year');
        $month = $request->input('month');


        if ($request->hasFile('wage_excel')) {
            $file = $request->file('wage_excel');

            try {
                $import = new TempEmployeeSalaryDetailsImport($companyId,$year,$month);
                Excel::import($import, $file);
                $notFoundAadhars = $import->getNotFoundAadhars();
                return redirect()->back()->with([
                    'class' => 'success','message' => 'Review the Result',
                    'not_found_aadhars' => $notFoundAadhars,
                    'companyId' => $companyId
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage());
                return redirect()->back()->with('error', 'There was an error uploading the file: ' . $e->getMessage())->withInput();
            }
        }

        return redirect()->back()->with('error', 'No file was uploaded.')->withInput();
    }
    public function getEmployeeDetails($id)
    {
        $employee = TempMonthlySalary::with('employee')->where('admin_id',$id)->get();
        
        if ($employee) {
            return response()->json(['class' => 'success','message' => 'Employee  found', 'employee' => $employee]);
        }
    
        return response()->json(['success' => false, 'message' => 'Employee not found']);
    }


    public function verify(Request $request)
{
    // Start a database transaction
    // dd($request->all());
    $tempSalaries = TempMonthlySalary::all();
    // dd($tempSalaries);
    DB::beginTransaction();

    try {
        // Retrieve the temporary salaries
        // $tempSalaries = TempMonthlySalary::where('company_id', $request->company_id)->get();

        // Initialize an array to store the IDs of successfully inserted records
        $insertedTempSalaryIds = [];

        // Loop through the temp salaries and insert each into MonthlySalaryDetail
        foreach ($tempSalaries as $tempSalary) {
            MonthlySalaryDetail::create([
                'employee_id' => intval($tempSalary->admin_id),
                'company_id' => intval($tempSalary->company_id),
                'year' => intval($tempSalary->year),
                'month' => $tempSalary->month,
                'working_days' => intval($tempSalary->working_days),
                'basic' => intval($tempSalary->basic),
                'pf_basic' => intval($tempSalary->pf_basic),
                'hra' => intval($tempSalary->hra),
                'conveyance' => intval($tempSalary->conveyance),
                'other_allowance' => intval($tempSalary->other_allowance),
                'basic_amount' => intval($tempSalary->basic_amount),
                'pf_basic_amount' => intval($tempSalary->pf_basic_amount),
                'hra_amount' => intval($tempSalary->hra_amount),
                'conveyance_amount' => intval($tempSalary->conveyance_amount),
                'other_allowance_amount' => intval($tempSalary->other_allowance_amount),
                'total_amount' => intval($tempSalary->total_amount),
                'epf_employee' => intval($tempSalary->epf_employee),
                'epf_employer' => intval($tempSalary->epf_employer),
                'eps_employer' => intval($tempSalary->eps_employer),
                'esi_employee' => intval($tempSalary->esi_employee),
                'esi_employer' => intval($tempSalary->esi_employer),
                'psdt_amount' => intval($tempSalary->psdt_amount),
                'tds_amount' => intval($tempSalary->tds_amount),
                'lwf_employer' => intval($tempSalary->lwf_employer),
                'lwf_employee' => intval($tempSalary->lwf_employee),
                'other_if_any' => intval($tempSalary->other_if_any),
                'total_deductions' => intval($tempSalary->total_deductions),
                'net_payable' => intval($tempSalary->net_payable),
                'advance' => intval($tempSalary->advance),
            ]);
        
            $insertedTempSalaryIds[] = $tempSalary->id;
        }
        

       
        DB::commit();

        TempMonthlySalary::whereIn('id', $insertedTempSalaryIds)->delete();

        return redirect()->back()->with(['class' => 'success', 'message' => 'Employee Salary uploaded successfully.']);

    } catch (\Exception $e) {
// dd($e->getMessage());

        // If there's an error, roll back the transaction
        DB::rollBack();
        // Log the error for debugging
        \Log::error('Salary upload failed: '.$e->getMessage());

        // Return with an error message
        return redirect()->back()->with(['class' => 'error', 'message' => 'Failed to upload employee salary.']);
    }
}


    public function cancel(){
        DB::table('tempmonthlysalary')->truncate();
        return redirect()->back()->with(['class' => 'success', 'message' => 'Upload Again']);
    }
    public function allsalary(){
        $companies = Company::
        where('entity_type', 'company')
        ->pluck('name', 'id');
        // dd($companies);
        return view('admin.salary.allsalariesdetail',compact('companies'));
    }
    public function viewSalary(Request $request,$company){
        $request->validate([
            'month' => 'required|string',
            'year' => 'required|integer',
        ]);

        $month = $request->input('month');
        $year = $request->input('year');
        // dd($month);
        // Fetch the salary details for the given company, month, and year
        $salaryDetails = MonthlySalaryDetail::with('employee') // Eager load the employee relationship
        ->where('company_id', $company)
        ->where('month', $month)
        ->where('year', $year)
        ->get();
        // dd($salaryDetails);
        if (count($salaryDetails)>0) {
           
            return view('admin.salary.singlecompanysalary',compact('salaryDetails'));
        }else{
            return redirect()->back()->with(['class'=>'success','message'=>'No salary sheet found for this month']);
        }
    
       

    }

    public function exportSalary($company, $month, $year){
        $salaryDetails = MonthlySalaryDetail::with('employee') // Eager load the employee relationship
        ->where('company_id', $company)
        ->where('month', $month)
        ->where('year', $year)
        ->get();
        $comapnyname=Company::find($company);
        // dd($comapnyname->name);
        return Excel::download(new SalaryExport($salaryDetails), $comapnyname->name.'salary_details.xlsx');
    }
}
