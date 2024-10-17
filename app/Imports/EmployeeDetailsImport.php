<?php

namespace App\Imports;

use App\Models\Tempemployeedetails;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Employee;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use App\Models\EmployeeDetails;

class EmployeeDetailsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $companyId;
    public $existingAadhars = []; 
    public function __construct($companyId)
    {
        $this->companyId = $companyId;
       
    }
    protected function parseDate($dateString, array $formats)
    {
        if (empty($dateString)) {
            Log::warning('Empty date string encountered.');
            return null;
        }
    
        // If the date is already a DateTime object, convert it to Carbon instance
        if ($dateString instanceof \DateTime) {
            return Carbon::instance($dateString)->startOfDay();
        }
    
        // Trim the date string to remove leading/trailing spaces
        $dateString = trim($dateString);
    
        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat($format, $dateString)->startOfDay();
            } catch (\Exception $e) {
                // Continue to the next format
                continue;
            }
        }
    
        // If none of the formats match, log the error and return null
        Log::error("Date parsing failed for string '$dateString'. Expected formats: " . implode(', ', $formats));
        return null;
    }
    
    public function model(array $row)
    {
         // Check if the Aadhar number already exists for the given company_id
         $existingEmployee = EmployeeDetails::whereHas('employee', function($query) {
            $query->where('company_id', $this->companyId);
        })->where('aadhar_no', $row['aadhar_no'])->first();

     // If it exists, store it in the existingAadhars array
     if ($existingEmployee) {
         $this->existingAadhars[] = $existingEmployee->aadhar_no; // Store Aadhar in array
         Log::info("Existing Aadhar number found: " . $existingEmployee->aadhar_no);
     }
        // dd($row);
        try {

            $date_of_relieving = (isset($row['date_of_relieving']) && strtoupper(trim($row['date_of_relieving'])) !== 'N/A')
            ? $this->parseDate($row['date_of_relieving'], ['d.m.Y', 'd/m/Y', 'Y-m-d'])
            : null;

        // Parse date_of_birth
        $date_of_birth = $this->parseDate($row['date_of_birth'], ['d.m.Y', 'd/m/Y', 'Y-m-d']);

        // Parse date_of_joining
        $date_of_joining = $this->parseDate($row['date_of_joining'], ['d.m.Y', 'd/m/Y', 'Y-m-d']);


            return new TempEmployeeDetails([
                'company_id' => $this->companyId,
                'employee_name' => $row['employee_name'],
                'email' => $row['email'],
                'father_or_husband_name' => $row['father_or_husband_name'],
                'gender' => $row['gender'],
                'aadhar_no' => $row['aadhar_no'],
                'mobile' => $row['mobile'],
                'bank_account_no' => $row['bank_account_no'],
                'bank_name' => $row['bank_name'],
                'ifsc_code' => $row['ifsccode'],
                'esic_no' => $row['esic_no'],
                'pf_no' => $row['pf_no'],
                'skill_level'=> $row['skill_type'],
                // Adjust the date formats as per your file's format
                'date_of_birth' => $date_of_birth,
                'date_of_joining' => $date_of_joining,
                'location' => $row['location'],
                'nationality' => $row['nationality'],
                'designation' => $row['designation'],
                'basic' => $row['basic'],
                'pf_basic' => $row['pf_basic'],
                'hra' => $row['hra'],
                'allowance' => $row['allowance'],
                'lwf' => $row['lwf'],
                'deduction' => $row['deduction'],
                'conveyance' => $row['conveyance'],
                'state' => $row['state'],
                'district' => $row['district'],
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('Error processing row: ' . json_encode($row) . ' Error: ' . $e->getMessage());
            return null;
        }
    }
    
    
}
