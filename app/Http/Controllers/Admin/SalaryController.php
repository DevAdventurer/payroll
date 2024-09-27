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


    public function verify(Request $request){
        $tempSalaries = TempMonthlySalary::where($request->company_id)->get();
        // dd($tempSalaries);
    foreach ($tempSalaries as $tempSalary) {
        // Create a new MonthlySalaryDetails record using mass assignment
        MonthlySalaryDetail::create([
            'employee_id' => $tempSalary->admin_id,
            'company_id'=>$tempSalary->company_id,
            'year' => $tempSalary->year,
            'month' => $tempSalary->month,
            'working_days' => $tempSalary->working_days,
            'basic' => $tempSalary->basic,
            'pf_basic' => $tempSalary->pf_basic,
            'hra' => $tempSalary->hra,
            'conveyance' => $tempSalary->conveyance,
            'other_allowance' => $tempSalary->other_allowance,
            'basic_amount' => $tempSalary->basic_amount,
            'pf_basic_amount' => $tempSalary->pf_basic_amount,
            'hra_amount' => $tempSalary->hra_amount,
            'conveyance_amount' => $tempSalary->conveyance_amount,
            'other_allowance_amount' => $tempSalary->other_allowance_amount,
            'total_amount' => $tempSalary->total_amount,
            'epf_employee' => $tempSalary->epf_employee,
            'epf_employer' => $tempSalary->epf_employer,
            'eps_employer' => $tempSalary->eps_employer,
            'esi_employee' => $tempSalary->esi_employee,
            'esi_employer' => $tempSalary->esi_employer,
            'psdt_amount' => $tempSalary->psdt_amount,
            'tds_amount' => $tempSalary->tds_amount,
            'lwf_employer' => $tempSalary->lwf_employer,
            'lwf_employee' => $tempSalary->lwf_employee,
            'other_if_any' => $tempSalary->other_if_any,
            'total_deductions' => $tempSalary->total_deductions,
            'net_payable' => $tempSalary->net_payable,
            'advance' => $tempSalary->advance,
        ]);

    }
    DB::table('tempmonthlysalary')->truncate();
    return redirect()->back()->with(['class' => 'success', 'message' => 'Employee Salary uploaded successfully.']);
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

        // Fetch the salary details for the given company, month, and year
        $salaryDetails = MonthlySalaryDetail::with('employee') // Eager load the employee relationship
        ->where('company_id', $company)
        ->where('month', $month)
        ->where('year', $year)
        ->get();
        // dd($salaryDetails);
        if ($salaryDetails) {
           
            return view('admin.salary.singlecompanysalary',compact('salaryDetails'));
        }
    
       

    }

    public function exportSalary($company, $month, $year){
        $salaryDetails = MonthlySalaryDetail::with('employee') // Eager load the employee relationship
        ->where('company_id', $company)
        ->where('month', $month)
        ->where('year', $year)
        ->get();
        return Excel::download(new SalaryExport($salaryDetails), 'salary_details.xlsx');
    }
}
