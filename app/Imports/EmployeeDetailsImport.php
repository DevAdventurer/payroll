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
                'date_of_birth' => \Carbon\Carbon::createFromFormat('d.m.Y', $row['date_of_birth']),
                'date_of_joining' => \Carbon\Carbon::createFromFormat('d.m.Y', $row['date_of_joining']),
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
            dd($e);
            Log::error('Error processing row: ' . json_encode($row) . ' Error: ' . $e->getMessage());
            return null;
        }
    }
    
    
}
