<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;
    protected $table = 'admin_salary';

    // Define the fields that are mass assignable
    protected $fillable = [
        'designation',
        'admin_id',      // Foreign key to connect with Admins table
        'basic',         // Basic Salary
        'pf_basic',      // PF Basic
        'hra',           // House Rent Allowance (HRA)
        'allowance',     // Allowance
        'lwf',           // Labour Welfare Fund (LWF)
        'deduction',     // Deduction (PF, ESI, etc.)
        'conveyance'     // Conveyance
    ];
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
