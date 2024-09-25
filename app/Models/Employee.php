<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table='admins'; 
    protected $fillable = [
        'name', 'email', 'password','role_id','mobile','gender','date_of_birth','company_id','entity_type','wages_id'
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->role_id = 4; 
            $model->entity_type = 'employee';
           
        });
    }
    public function company()
    {
        return $this->belongsTo(Employee::class, 'company_id', 'id'); 
    }
    public function employeedetail()
{
    return $this->hasOne(EmployeeDetails::class, 'admin_id', 'id');
}
    public function scopeEmployees($query)
    {
        return $query->where('role_id', 4); 
    }
    public function tempMonthlySalaries()
    {
        return $this->hasMany(TempMonthlySalary::class, 'admin_id');
    }
}
