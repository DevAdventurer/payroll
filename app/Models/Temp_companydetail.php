<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_companydetail extends Model
{
    use HasFactory;
    protected $table = 'temp_companydetails';

    protected $fillable = [
        'company_name',
        'type',
        'owner_name',
        'contact_no',
        'city',
        'distt',
        'state',
        'address',
        'gst_no',
        'pan_no',
        'aadhar_no',
        'udyam_no',
        'cin_no',
        'epf_no',
        'esic_no',
        'bank_name',
        'ac_no',
        'ifs_code',
    ];
}
