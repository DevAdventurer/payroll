<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Wage;
use App\Models\TempMonthlySalary;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TempEmployeeSalaryDetailsImport implements ToModel, WithHeadingRow
{
    protected $companyId;
    protected $year;
    protected $month;
    protected $notFoundAadhars = [];
    public function __construct($companyId,$year,$month)
    {
        $this->companyId = $companyId;
         $this->year = $year;
          $this->month = $month;

    }

    public function model(array $row)
{
    $aadhar = $row['aadhar_card']; 
    $advance = $row['advance'];
    $totalAmount = $row['amount'] ?? null; 

    // Get the number of working days in the current month
    $currentMonth = Carbon::now();
    $workingDays = $currentMonth->daysInMonth; // Total days in the month

    // Find the employee based on company ID and Aadhar number
    $employee = Employee::where('company_id', $this->companyId)
        ->whereHas('employeedetail', function ($query) use ($aadhar) {
            $query->where('aadhar_no', $aadhar);
        })->first();

    if ($employee) {
        $basicsalary = Wage::find($employee->wages_id);
        $basic = $basicsalary->amount;

        // Calculate various components
        $hra = $basic * 0.10; 
        $pfBasic = $basic * 0.12; 
        $conveyance = 500; 
        $otherAllowance = 0; 

        // Create a new TempMonthlySalary instance
        $tempMonthlySalary = new TempMonthlySalary();
        $tempMonthlySalary->company_id=$this->companyId;
        // Initial assignment of attributes
        $tempMonthlySalary->admin_id = $employee->id;
        $tempMonthlySalary->month = $this->month;
        $tempMonthlySalary->year =  $this->year;

        // Reduce working days if totalAmount is less than net payable
        do {
            // Calculate salary components based on the current working days
            $tempMonthlySalary->working_days = $workingDays;
            $tempMonthlySalary->basic = $basic;
            $tempMonthlySalary->pf_basic = $pfBasic;
            $tempMonthlySalary->hra = $hra;
            $tempMonthlySalary->conveyance = $conveyance;
            $tempMonthlySalary->other_allowance = $otherAllowance;

            // Amount calculations based on working days
            $tempMonthlySalary->basic_amount = ($basic / $currentMonth->daysInMonth) * $workingDays; 
            $tempMonthlySalary->pf_basic_amount = ($pfBasic / $currentMonth->daysInMonth) * $workingDays;
            $tempMonthlySalary->hra_amount = ($hra / $currentMonth->daysInMonth) * $workingDays;
            $tempMonthlySalary->conveyance_amount = ($conveyance / $currentMonth->daysInMonth) * $workingDays;
            $tempMonthlySalary->other_allowance_amount = ($otherAllowance / $currentMonth->daysInMonth) * $workingDays;

            // Salary calculations
            $salaryAndWages = $tempMonthlySalary->basic_amount + 
                              $tempMonthlySalary->hra_amount + 
                              $tempMonthlySalary->conveyance_amount + 
                              $tempMonthlySalary->other_allowance_amount;

            $tempMonthlySalary->total_amount = $totalAmount;
            $tempMonthlySalary->epf_employee = $pfBasic * 0.12; 
            $tempMonthlySalary->epf_employer = $pfBasic * 0.12; 
            $tempMonthlySalary->eps_employer = $pfBasic * 0.0833; 
            $tempMonthlySalary->esi_employee = $totalAmount > 21000 ? 0 : $totalAmount * 0.0075; 
            $tempMonthlySalary->esi_employer = $totalAmount > 21000 ? 0 : $totalAmount * 0.0325; 
            $tempMonthlySalary->psdt_amount = $totalAmount > 21000 ? 200 : 0; 
            $tempMonthlySalary->tds_amount = 0; 
            $tempMonthlySalary->lwf_employer = 20; 
            $tempMonthlySalary->lwf_employee = 5; 
            $tempMonthlySalary->other_if_any = 0; 

            // Total deductions
            $tempMonthlySalary->total_deductions = 
                $tempMonthlySalary->epf_employee + 
                $tempMonthlySalary->esi_employee + 
                $tempMonthlySalary->psdt_amount + 
                $tempMonthlySalary->tds_amount + 
                $tempMonthlySalary->other_if_any + 
                $advance;

            // Net payable salary
            $tempMonthlySalary->net_payable = $salaryAndWages - $tempMonthlySalary->total_deductions;

            // Reduce working days if net payable is greater than the total amount
            $workingDays--;

        } while ($totalAmount < $tempMonthlySalary->net_payable && $workingDays > 0);
        // dd($tempMonthlySalary);
        // Save the record
        $tempMonthlySalary->save();
    } else {
        $this->notFoundAadhars[] = $aadhar;
    }
}

    public function getNotFoundAadhars()
    {
        return $this->notFoundAadhars;
    }
}