<?php

namespace App\Imports;

use App\Models\Tempemployeedetails;
use Maatwebsite\Excel\Concerns\ToModel;

class TempEmployeeSalaryDetailsImport implements ToModel
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
        
        return new Tempemployeedetails([
            'employee_name' => $row['employee_name'],
            'father_or_husband_name' => $row['father_or_husband_name'],
            'gender' => $row['gender'],
            'aadhar_no' => $row['aadhar_no'],
            'mobile' => $row['mobile'],
            'bank_account_no' => $row['bank_account_no'],
            'bank_name' => $row['bank_name'],
            'ifsc_code' => $row['ifsc_code'],
            'esic_no' => $row['esic_no'],
            'pf_no' => $row['pf_no'],
            'date_of_birth' => $row['date_of_birth'],
            'date_of_joining' => $row['date_of_joining'],
            'date_of_relieving' => $row['date_of_relieving'],
            'location' => $row['location'],
            'nationality' => $row['nationality'],
            'state' => $row['state'],
            'district' => $row['distt'],
            'city' => $row['city'],
            'designation' => $row['designation'],
            'basic' => $row['basic'],
            'pf_basic' => $row['pfbasic'],
            'hra' => $row['hra'],
            'allowance' => $row['allowance'],
            'lwf' => $row['lwf'],
            'deduction' => $row['deduction'],
            'conveyance' => $row['conveyance'],
            'skill_level' => $row['skilllevel'],
        ]);
    }
}
