<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tempemployeedetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_name',
        'father_or_husband_name',
        'gender',
        'aadhar_no',
        'mobile',
        'bank_account_no',
        'bank_name',
        'ifsc_code',
        'esic_no',
        'pf_no',
        'date_of_birth',
        'date_of_joining',
        'date_of_relieving',
        'location',
        'nationality',
        'state',
        'district',
        'city',
        'designation',
        'basic',
        'pf_basic',
        'hra',
        'allowance',
        'lwf',
        'deduction',
        'conveyance',
        'skill_level',
    ];
}
