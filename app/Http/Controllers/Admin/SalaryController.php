<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\TempMonthlySalary;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TempEmployeeSalaryDetailsImport;
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
                    'success' => 'Employee salary details uploaded successfully.',
                    'not_found_aadhars' => $notFoundAadhars
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'There was an error uploading the file: ' . $e->getMessage())->withInput();
            }
        }

        return redirect()->back()->with('error', 'No file was uploaded.')->withInput();
    }
    public function getEmployeeDetails($id)
    {
        $employee = TempMonthlySalary::with('employee')->where('admin_id',$id)->get();
        
        if ($employee) {
            return response()->json(['success' => true, 'employee' => $employee]);
        }
    
        return response()->json(['success' => false, 'message' => 'Employee not found']);
    }
    
}
