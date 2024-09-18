<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table='admins'; 
    protected $fillable = [
        'name', 'email', 'password','role_id','mobile'
    ];
    protected static function boot()
    {
        parent::boot();

        // Listen to the creating event to set the role_id automatically
        static::creating(function ($model) {
            $model->role_id = 3; // Set a default role_id, e.g., 3
        });
    }
    public function details()
    {
        return $this->hasOne(CompanyDtails::class, 'admin_id', 'id');
    }
    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id', 'id');
    }
    public function scopeCompanies($query)
    {
        return $query->where('role_id', 3); // Assuming role_id 3 is for companies
    }
   
}
