<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempMonthlySalary extends Model
{
    use HasFactory;
    protected $table='tempmonthlysalary';
    protected $fillable = [
        'admin_id', 
        'month', 
        'year', 
        'working_days', 
        'basic', 
        'pf_basic', 
        'hra', 
        'conveyance', 
        'other_allowance', 
        'basic_amount', 
        'pf_basic_amount', 
        'hra_amount', 
        'conveyance_amount', 
        'other_allowance_amount', 
        'rate_of_pay', 
        'epf_employee', 
        'epf_employer', 
        'eps_employer', 
        'esi_employee', 
        'esi_employer', 
        'advance', 
        'total_deductions', 
        'net_payable',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'admin_id');
    }
}
