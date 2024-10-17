<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table='admins'; 
    protected $fillable = [
        'name', 'email', 'password','role_id','mobile','entity_type','monthly_fees','services'
    ];
    protected static function boot()
    {
        parent::boot();

        // Listen to the creating event to set the role_id automatically
        static::creating(function ($model) {
            $model->role_id = 3; // Set a default role_id, e.g., 3
            $model->entity_type = 'company';
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
    public function services()
    {
        return $this->hasMany(Services::class, 'id', 'services'); // Assuming 'id' in Service corresponds to values in services array
    }
    public function scopeCompanies($query)
    {
        return $query->where('role_id', 3); // Assuming role_id 3 is for companies
    }
   
}
