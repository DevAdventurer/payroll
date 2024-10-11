<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalaryExport implements FromCollection, WithHeadings
{
    protected $salaryDetails;

    public function __construct($salaryDetails)
    {
        $this->salaryDetails = $salaryDetails;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Map the salary details to an array format
        return $this->salaryDetails->map(function ($detail) {
            return [
                'Employee Name' => $detail->employee->name,  // Assuming employee relationship is loaded
                'Year' => $detail->year,
                'Month' => $detail->month,
                'Working Days' => $detail->working_days,
                'Basic' => $detail->basic,
                'PF Basic' => $detail->pf_basic,
                'HRA' => $detail->hra,
                'Conveyance' => $detail->conveyance,
                'Other Allowance' => $detail->other_allowance,
                'Advance' => $detail->advance,
                'Total Amount' => $detail->total_amount,
                'EPF (Employee)' => $detail->epf_employee,
                'EPF (Employer)' => $detail->epf_employer,
                'EPS (Employer)' => $detail->eps_employer,
                'ESI (Employee)' => $detail->esi_employee,
                'ESI (Employer)' => $detail->esi_employer,
                'LWF EMPLOYER' => $detail->lwf_employer,
                'LWF EMPLOYEE' => $detail->lwf_employee,
                'Total Deductions' => $detail->total_deductions,
                'Net Payable' => $detail->net_payable,
            ];
            
        });
    }

    public function headings(): array
    {
        return [
            'Employee Name',
            'Year',
            'Month',
            'Working Days',
            'Basic',
            'PF Basic',
            'HRA',
            'Conveyance',
            'Other Allowance',
            'Advance',
            'Total Amount',
            'EPF (Employee)',
            'EPF (Employer)',
            'EPS (Employer)',
            'ESI (Employee)',
            'ESI (Employer)',
            'LWF EMPLOYER' ,
            'LWF EMPLOYEE' ,
            'Total Deductions',
            'Net Payable',
            
        ];
    }
}
