<?php

namespace App\Exports;

use App\Models\Employeedetials;
use App\Models\MonthlySalaryDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\EmployeeDetails;

class LWFExport implements FromCollection, WithHeadings
{
    protected $employees;
    protected  $months;
    public function __construct($employees, $months)
    {
        $this->employees = $employees;
        $this->months= $months;
        
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
{
    $nationalityMap = [
        0 => 'Punjab',
        1 => 'India',
        2 => 'Non-India',
    ];
    return $this->employees->map(function ($employee) {
        $id = $employee->employee_id;
        $presentMonths = MonthlySalaryDetail::where('employee_id', $id)
        ->where('year', $employee->year)
        ->whereIn('month', $this->months)
        ->count();
        $presentMonths=6 - $presentMonths;
        // dd($presentMonths); 
        // Fetch employee details using admin_id
        $details = EmployeeDetails::where('admin_id', $id)->first();
        if (!$details) {
            $details = null;
        }
        // If no details are found, you can initialize an empty fallback object or array
        $details = $details ?? (object) [];
        
        // Map the data, using 'N/A' if any value is missing (null)
        return [
            $employee->employee->name ?? 'N/A', // Employee's name
            $details->father_or_husband_name ?? 'N/A', // Father or Husband Name from EmployeeDetails
            $employee->employee->gender ?? 'N/A', // Employee's gender
            'A'.($details->aadhar_no ?? 'N/A'), // Aadhar Number
            $details->mobile ?? 'N/A', // Mobile number
            'A' . ($details->ac_no ?? 'N/A'), // Bank account number prefixed with 'A'
            $details->bank_name ?? 'N/A', // Bank name
            $details->ifs_code ?? 'N/A', // IFSC code
            $employee->esic_no ?? 'N/A', // ESIC number
            $employee->pf_no ?? 'N/A', // PF number
            $employee->date_of_birth ?? 'N/A', // Date of birth
            $details->date_of_joining ?? 'N/A', // Date of joining
            $details->date_of_relieving ?? 'N/A', // Date of relieving
            $details->location ?? 'N/A', // Location
            '1_'.($details->nationality  ?? 'N/A'), // Nationality (could be mapped as per 0/1/2 logic)
            $presentMonths ?? 'N/A', // Months on leave
        ];
    });
}

    public function headings(): array
    {
        return [
            'Employee_Name',
            'Father_Or_Husband_Name',
            'Gender',
            "Aadhar_Or_Passport_No(Write_'A'_Before_Aadhar_Write_'P'_Before_PassportNo)",
            'Mobile',
            "Bank_Account_No(Write_'A'_Before_AccNo)",
            'Bank_Name',
            'IFSCCode',
            'ESIC_No',
            'PF_No',
            'Date_of_Birth',
            'Date_of_Joining',
            'Date_of_Relieving',
            'Location',
            'Nationality(0_Punjab_1_India_2_Non-India)',
            'No_Of_Months_Employee_On_Leave(IfAny)',
        ];
    }
}
