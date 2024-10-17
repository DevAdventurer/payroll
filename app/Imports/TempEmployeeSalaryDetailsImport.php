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
     /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $companyId;
    protected $year;
    protected $month;
    protected $notFoundAadhars = [];
    public function getDaysInMonth($monthName, $year) {
        // Create a Carbon instance for the first day of the specified month and year
        $validMonths = [
            'January', 'February', 'March', 'April', 
            'May', 'June', 'July', 'August', 
            'September', 'October', 'November', 'December'
        ];
    
        // Check if the provided month name is valid
        if (!in_array($monthName, $validMonths)) {
            return "Invalid month name.";
        }
    
        // Convert the month name to a month number
        $month = Carbon::parse($monthName)->month;
    
        // Create a Carbon instance for the first day of the specified month and year
        $date = Carbon::createFromDate($year, $month, 1);
        
        // Return the number of days in that month
        return $date->daysInMonth;
    }
    public function __construct($companyId,$year,$month)
    {
        $this->companyId = $companyId;
         $this->year = $year;
          $this->month = $month;

    }

    public function model(array $row)
    {
        // dd(count($row));

        if (!isset($row['aadhar_no'])) {
            // Log an error message and skip this row
           // Log::warning("Missing aadhar_no in row: " . json_encode($row));
            return; // Skip further processing for this row
        }
                // Retrieve Aadhar and other values from the row
                $aadhar = $row['aadhar_no']; 
                $advance = $row['advance'];
                $totalAmount = $row['amount'] ?? 0; 
                $currentMonth = Carbon::now();
                $workingDays =  $this->getDaysInMonth($this->month, $this->year);
                $totaldays= $this->getDaysInMonth($this->month, $this->year);
                // dd($workingDays);
            
                $employee = Employee::with('employeedetail') 
                ->where('company_id', $this->companyId)
                ->whereHas('employeedetail', function ($query) use ($aadhar) {
                    $query->where('aadhar_no', $aadhar);
                })->first();
// dd($employee);
                if ($employee) {
                        
                    if ($totalAmount == 0){
                            $workingDays = 0; 
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
                            $tempMonthlySalary->basic = intval(round($basic)); 
                            $tempMonthlySalary->pf_basic = intval(round($pfBasic));
                            $tempMonthlySalary->hra = '0';
                            $tempMonthlySalary->conveyance = intval(round($conveyance));
                            $tempMonthlySalary->other_allowance = intval(round($otherAllowance));
                            $tempMonthlySalary->basic_amount = 0;
                            $tempMonthlySalary->pf_basic_amount = 0;
                            $tempMonthlySalary->hra_amount = 0;
                            $tempMonthlySalary->conveyance_amount = 0;
                            $tempMonthlySalary->other_allowance_amount = 0;
                            $tempMonthlySalary->rate_of_pay = 0;
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
                            
                        
                            $tempMonthlySalary->save();
                            return; 
                    }

                      
                        $basic = $employee->employeedetail->basic;
                        $hra = $employee->employeedetail->hra;
                        $pfBasic = $employee->employeedetail->pf_basic;
                        $conveyance = $employee->employeedetail->conveyance;
                        $otherAllowance = $employee->employeedetail->allowance;

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
                            $tempMonthlySalary->basic = $basic; // No conversion
                            $tempMonthlySalary->pf_basic = $pfBasic; // No conversion
                            $tempMonthlySalary->hra = $hra; // No conversion
                            $tempMonthlySalary->conveyance = $conveyance; // No conversion
                            $tempMonthlySalary->other_allowance = $otherAllowance; // No conversion
                        
                            // Amount calculations based on working days
                            $tempMonthlySalary->basic_amount = ($basic / $totaldays) * $workingDays; 
                            $tempMonthlySalary->pf_basic_amount = ($pfBasic / $totaldays) * $workingDays;
                            $tempMonthlySalary->hra_amount = ($hra / $totaldays) * $workingDays;
                            $tempMonthlySalary->conveyance_amount = ($conveyance / $totaldays) * $workingDays;
                            $tempMonthlySalary->other_allowance_amount = ($otherAllowance / $totaldays) * $workingDays;
                        
                            // Calculate total salary and wages
                            $salaryAndWages = $tempMonthlySalary->basic_amount + 
                                              $tempMonthlySalary->hra_amount + 
                                              $tempMonthlySalary->conveyance_amount + 
                                              $tempMonthlySalary->other_allowance_amount;
                        
                            // EPF, ESI, LWF, and other deductions based on current working days
                            $tempMonthlySalary->rate_of_pay = $salaryAndWages; // No conversion
                            $tempMonthlySalary->epf_employee = ($pfBasic * 0.12) * ($workingDays / $totaldays); 
                            $tempMonthlySalary->epf_employer = ($pfBasic * 0.0367) * ($workingDays / $totaldays); 
                            $tempMonthlySalary->eps_employer = ($pfBasic * 0.0833) * ($workingDays / $totaldays); 
                            $tempMonthlySalary->esi_employee = $salaryAndWages > 21000 ? 0 : ($salaryAndWages * 0.0075) * ($workingDays / $totaldays); 
                            $tempMonthlySalary->esi_employer = $salaryAndWages > 21000 ? 0 : ($salaryAndWages * 0.0325) * ($workingDays / $totaldays); 
                            $tempMonthlySalary->psdt_amount = $salaryAndWages > 21000 ? 200 : 0; 
                            $tempMonthlySalary->tds_amount = 0; 
                            $tempMonthlySalary->lwf_employer = 20 * ($workingDays / $totaldays); 
                            $tempMonthlySalary->lwf_employee = 5 * ($workingDays / $totaldays); 
                            $tempMonthlySalary->other_if_any = 0;
                        
                            // Total deductions based on adjusted working days
                            $tempMonthlySalary->total_deductions = 
                                $tempMonthlySalary->epf_employee + 
                                $tempMonthlySalary->esi_employee + 
                                $tempMonthlySalary->psdt_amount + 
                                $tempMonthlySalary->tds_amount + 
                                $tempMonthlySalary->other_if_any + 
                                $advance + 
                                $tempMonthlySalary->lwf_employee;
                        
                            // Calculate net payable salary
                            $tempMonthlySalary->net_payable = $salaryAndWages - $tempMonthlySalary->total_deductions;
                        
                            // Calculate the total of required deductions
                            $totalRequiredDeductions = 
                                $tempMonthlySalary->epf_employee + 
                                $tempMonthlySalary->esi_employee + 
                                $tempMonthlySalary->lwf_employee + 
                                $tempMonthlySalary->net_payable;
                        
                            // Reduce working days if the total amount is less than required deductions
                            $workingDays--;
                        
                        }
                         while ($totalAmount < $totalRequiredDeductions && $workingDays > 0);

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