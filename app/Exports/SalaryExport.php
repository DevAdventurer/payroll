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
                'Basic' => number_format($detail->basic, 2),
                'PF Basic' => number_format($detail->pf_basic, 2),
                'HRA' => number_format($detail->hra, 2),
                'Conveyance' => number_format($detail->conveyance, 2),
                'Other Allowance' => number_format($detail->other_allowance, 2),
                'Total Amount' => number_format($detail->total_amount, 2),
                'EPF (Employee)' => number_format($detail->epf_employee, 2),
                'EPF (Employer)' => number_format($detail->epf_employer, 2),
                'EPS (Employer)' => number_format($detail->eps_employer, 2),
                'ESI (Employee)' => number_format($detail->esi_employee, 2),
                'ESI (Employer)' => number_format($detail->esi_employer, 2),
                'Total Deductions' => number_format($detail->total_deductions, 2),
                'Net Payable' => number_format($detail->net_payable, 2),
                'Advance' => number_format($detail->advance, 2),
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
            'Total Amount',
            'EPF (Employee)',
            'EPF (Employer)',
            'EPS (Employer)',
            'ESI (Employee)',
            'ESI (Employer)',
            'Total Deductions',
            'Net Payable',
            'Advance',
        ];
    }
}
