<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\MonthlySalaryDetail;
use App\Exports\LWFExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


class LwfController extends Controller
{
    public function index(){
        $companies = Company::where('entity_type', 'company')->get();
        return view('admin.lwf.create',compact('companies'));
    }

    public function store(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'company_id' => 'required',
        'duration'   => 'required|in:April - September,October - March',
        'year'       => 'required|integer|min:2000', // Adjust the year range
    ]);

    $companyId = $validated['company_id'];
    $year = $validated['year'];
    $duration = $validated['duration'];

    // Determine the months based on duration
    if ($duration === 'April - September') {
        $months = ['April', 'May', 'June', 'July', 'August', 'September'];
        // dd($months);
    } else {
        $months = ['October', 'November', 'December', 'January', 'February', 'March'];
    }
   

    // Query the monthly_salary model
    $employees = MonthlySalaryDetail::where('company_id', $companyId)
                    ->where('year', $year)
                    ->whereIn('month', $months)->with('employee')->with('employeedetails')
                    ->get();
                   

// Print the SQL query and the bindings
// dd($employees);
    // dd($employees);
    // Pass data to export function
    return Excel::download(new LWFExport($employees, $months), 'employees.xlsx');
}
}
