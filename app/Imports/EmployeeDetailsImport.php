<?php

namespace App\Imports;

use App\Models\Tempemployeedetails;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EmployeeDetailsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $companyId;

    public function __construct($companyId)
    {
        $this->companyId = $companyId;
    }

    public function model(array $row)
    {
       
        return new TempEmployeeDetails([
            'company_id' => $this->companyId,
            'employee_name' => $row['employee_name'], // Use correct keys
            'email' => $row['email'], 
        'father_or_husband_name' => $row['father_or_husband_name'],
        'gender' => $row['gender'],
        'aadhar_no' => $row['aadhar_no'], // Make sure key matches exactly
        'mobile' => $row['mobile'],
        'bank_account_no' => $row['bank_account_no'],
        'bank_name' => $row['bank_name'],
        'ifsc_code' => $row['ifsccode'], // Use correct key
        'esic_no' => $row['esic_no'],
        'pf_no' => $row['pf_no'],
       'date_of_birth' => Carbon::createFromFormat('dmy', $row['date_of_birth']), // Adjust the format as needed
        'date_of_joining' => Carbon::createFromFormat('dmy', $row['date_of_joining']), // Adjust the format as needed
      
        'location' => $row['location'],
        'nationality' => $row['nationality'],
        'designation' => $row['designation'],
        'basic' => $row['basic'],
        'pf_basic' => $row['pfbasic'], // Use correct key
        'hra' => $row['hra'],
        'allowance' => $row['allowance'],
        'lwf' => $row['lwf'],
        'deduction' => $row['deduction'],
        'conveyance' => $row['conveyance'],
        'state'=> $row['state'],
        'district'=> $row['district'],
        ]);
    }
}
