<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class Company extends Model
{

    use HasFactory;
    protected $table = 'admins';

    protected static function booted()
    {
        static::addGlobalScope('company', function ($query) {
            $query->where('role_id', '=', 4);
        });
        static::creating(function ($company) {
            $company->role_id = 4;
        });
    }

    

    public function media(){
        return $this->hasOne(Media::class,'id','media_id');
    }

    public function state(){
        return $this->hasOne(State::class,'id','state_id');
    }

    public function district(){
        return $this->hasOne(District::class,'id','district_id');
    }

    public function city(){
        return $this->hasOne(City::class,'id','city_id');
    }

}
