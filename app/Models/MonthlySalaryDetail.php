<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlySalaryDetail extends Model
{
    use HasFactory;
    protected $table = 'monthlysalarydetails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'employee_id',
        'company_id',
        'year',
        'month',
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
        'total_amount',
        'epf_employee',
        'epf_employer',
        'eps_employer',
        'esi_employee',
        'esi_employer',
        'psdt_amount',
        'tds_amount',
        'lwf_employer',
        'lwf_employee',
        'other_if_any',
        'total_deductions',
        'net_payable',
        'advance',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
