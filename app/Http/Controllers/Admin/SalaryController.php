<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TempEmployeeSalaryDetailsImport;
class SalaryController extends Controller
{
    public function index(){
        $companies = Company::whereNotNull('company_id')->pluck('name', 'id');

        return view('admin.salary.create',compact('companies'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:admins,id',
            'wage_excel' => 'required|file|mimes:xlsx,xls,csv|max:2048',
        ]);

        $companyId = $request->input('company_id');

        if ($request->hasFile('wage_excel')) {
            $file = $request->file('wage_excel');

            try {
                // Create an instance of the import class with the company ID
                $import = new TempEmployeeSalaryDetailsImport($companyId);

                // Import the data from the file
                Excel::import($import, $file);

                return redirect()->back()->with('success', 'Employee salary details uploaded successfully.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'There was an error uploading the file: ' . $e->getMessage())->withInput();
            }
        }

        return redirect()->back()->with('error', 'No file was uploaded.')->withInput();
    }
}
