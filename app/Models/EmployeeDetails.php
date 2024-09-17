<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDetails extends Model
{
    use HasFactory;
    protected $table = 'admin_details';
    protected $fillable = [
        'admin_id',
        'father_or_husband_name',
        'aadhar_no',
        'ac_no',
        'bank_name',
        'ifs_code',
        'esic_no',
        'epf_no',
        'date_of_joining',
        'date_of_relieving',
        'location',
        'nationality',
    ];

    public function employee()
{
    return $this->belongsTo(Employee::class, 'admin_id', 'id');
}
}
