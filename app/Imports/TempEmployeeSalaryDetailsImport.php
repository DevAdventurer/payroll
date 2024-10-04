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
    // Retrieve Aadhar and other values from the row
    $aadhar = $row['aadhar_no']; 
    $advance = $row['advance'];
    $totalAmount = $row['amount'] ?? 0; // Ensure default to 0 if not set

    // Get the number of working days in the current month
    $currentMonth = Carbon::now();
    $workingDays = $currentMonth->daysInMonth; // Total days in the month

    // Find the employee based on company ID and Aadhar number
    $employee = Employee::with('employeedetail') // Eager load the 'employeedetail' relationship
    ->where('company_id', $this->companyId)
    ->whereHas('employeedetail', function ($query) use ($aadhar) {
        $query->where('aadhar_no', $aadhar);
    })->first();

    // Check if employee exists
    if ($employee) {
        // If totalAmount is 0, set working days to 0 and skip calculations
        if ($totalAmount == 0) {
            $workingDays = 0; // Set working days to 0
            $basic = $employee->employeedetail->basic;
            $hra = $employee->employeedetail->hra;
            $pfBasic = $employee->employeedetail->pf_basic;
            $conveyance = $employee->employeedetail->conveyance;
            $otherAllowance = $employee->employeedetail->deduction;
            // Create a new TempMonthlySalary instance and set all values to zero
            $tempMonthlySalary = new TempMonthlySalary();
            $tempMonthlySalary->company_id = $this->companyId;
            $tempMonthlySalary->admin_id = $employee->id;
            $tempMonthlySalary->month = $this->month;
            $tempMonthlySalary->year = $this->year;
            $tempMonthlySalary->working_days = $workingDays;
            $tempMonthlySalary->basic = intval(round($basic)); // Convert to integer after rounding
            $tempMonthlySalary->pf_basic = intval(round($pfBasic));
            $tempMonthlySalary->hra = intval(round($hra));
            $tempMonthlySalary->conveyance = intval(round($conveyance));
            $tempMonthlySalary->other_allowance = intval(round($otherAllowance));
            $tempMonthlySalary->basic_amount = 0;
            $tempMonthlySalary->pf_basic_amount = 0;
            $tempMonthlySalary->hra_amount = 0;
            $tempMonthlySalary->conveyance_amount = 0;
            $tempMonthlySalary->other_allowance_amount = 0;
            $tempMonthlySalary->total_amount = 0;
            $tempMonthlySalary->epf_employee = 0;
            $tempMonthlySalary->epf_employer = 0;
            $tempMonthlySalary->eps_employer = 0;
            $tempMonthlySalary->esi_employee = 0;
            $tempMonthlySalary->esi_employer = 0;
            $tempMonthlySalary->psdt_amount = 0;
            $tempMonthlySalary->tds_amount = 0;
            $tempMonthlySalary->lwf_employer = 0;
            $tempMonthlySalary->lwf_employee = 0;
            $tempMonthlySalary->other_if_any = 0;
            $tempMonthlySalary->total_deductions = 0;
            $tempMonthlySalary->net_payable = 0;
            
            // Save the record directly and skip further calculations
            $tempMonthlySalary->save();
            return; // Exit the function early
        }

        // Continue with calculations if totalAmount is not 0
        $basicsalary = Wage::where('skill_level', $employee->skillset)->where('is_active', 1)->get();

        $basic = $employee->employeedetail->basic;
        $hra = $employee->employeedetail->hra;
        $pfBasic = $employee->employeedetail->pf_basic;
        $conveyance = $employee->employeedetail->conveyance;
        $otherAllowance = $employee->employeedetail->deduction;

        // Create a new TempMonthlySalary instance
        $tempMonthlySalary = new TempMonthlySalary();
        $tempMonthlySalary->company_id = $this->companyId;
        $tempMonthlySalary->admin_id = $employee->id;
        $tempMonthlySalary->month = $this->month;
        $tempMonthlySalary->year = $this->year;

        // Calculate salary components
        do {
            // Set current working days
            $tempMonthlySalary->working_days = $workingDays;
            $tempMonthlySalary->basic = intval(round($basic)); // Convert to integer after rounding
            $tempMonthlySalary->pf_basic = intval(round($pfBasic));
            $tempMonthlySalary->hra = intval(round($hra));
            $tempMonthlySalary->conveyance = intval(round($conveyance));
            $tempMonthlySalary->other_allowance = intval(round($otherAllowance));

            // Amount calculations based on working days
            $tempMonthlySalary->basic_amount = intval(round(($basic / $currentMonth->daysInMonth) * $workingDays)); 
            $tempMonthlySalary->pf_basic_amount = intval(round(($pfBasic / $currentMonth->daysInMonth) * $workingDays));
            $tempMonthlySalary->hra_amount = intval(round(($hra / $currentMonth->daysInMonth) * $workingDays));
            $tempMonthlySalary->conveyance_amount = intval(round(($conveyance / $currentMonth->daysInMonth) * $workingDays));
            $tempMonthlySalary->other_allowance_amount = intval(round(($otherAllowance / $currentMonth->daysInMonth) * $workingDays));

            // Calculate total salary and wages
            $salaryAndWages = intval(round($tempMonthlySalary->basic_amount + 
                          $tempMonthlySalary->hra_amount + 
                          $tempMonthlySalary->conveyance_amount + 
                          $tempMonthlySalary->other_allowance_amount));

            // EPF, ESI, LWF, and other deductions based on current working days
            $tempMonthlySalary->total_amount = intval(round($totalAmount));
            $tempMonthlySalary->epf_employee = intval(round(($pfBasic * 0.12) * ($workingDays / $currentMonth->daysInMonth))); 
            $tempMonthlySalary->epf_employer = intval(round(($pfBasic * 0.0367) * ($workingDays / $currentMonth->daysInMonth))); 
            $tempMonthlySalary->eps_employer = intval(round(($pfBasic * 0.0833) * ($workingDays / $currentMonth->daysInMonth))); 
            $tempMonthlySalary->esi_employee = $totalAmount > 21000 ? 0 : intval(round(($totalAmount * 0.0075) * ($workingDays / $currentMonth->daysInMonth))); 
            $tempMonthlySalary->esi_employer = $totalAmount > 21000 ? 0 : intval(round(($totalAmount * 0.0325) * ($workingDays / $currentMonth->daysInMonth))); 
            $tempMonthlySalary->psdt_amount = $totalAmount > 21000 ? 200 : 0; 
            $tempMonthlySalary->tds_amount = 0; 
            $tempMonthlySalary->lwf_employer = intval(round(20 * ($workingDays / $currentMonth->daysInMonth))); 
            $tempMonthlySalary->lwf_employee = intval(round(5 * ($workingDays / $currentMonth->daysInMonth))); 
            $tempMonthlySalary->other_if_any = 0;

            // Total deductions based on adjusted working days
            $tempMonthlySalary->total_deductions = intval(round(
                $tempMonthlySalary->epf_employee + 
                $tempMonthlySalary->esi_employee + 
                $tempMonthlySalary->psdt_amount + 
                $tempMonthlySalary->tds_amount + 
                $tempMonthlySalary->other_if_any + 
                $advance + $tempMonthlySalary->lwf_employee
            ));

            // Calculate net payable salary
            $tempMonthlySalary->net_payable = intval(round($salaryAndWages - $tempMonthlySalary->total_deductions));

            // Calculate the total of required deductions
            $totalRequiredDeductions = intval(round(
                $tempMonthlySalary->epf_employee + 
                $tempMonthlySalary->esi_employee + 
                $tempMonthlySalary->lwf_employee + 
                $tempMonthlySalary->net_payable
            ));

            // Reduce working days if the total amount is less than required deductions
            $workingDays--;

        } while ($totalAmount < $totalRequiredDeductions && $workingDays > 0);

        // Save the record
        $tempMonthlySalary->save();
    } else {
        $this->notFoundAadhars[] = $aadhar; // Track missing Aadhars
    }
}


    public function getNotFoundAadhars()
    {
        return $this->notFoundAadhars;
    }
}