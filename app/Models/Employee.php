<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class Employee extends Model
{

    use HasFactory;
    protected $table = 'admins';

    protected static function booted()
    {
        static::addGlobalScope('employee', function ($query) {
            $query->whereNotIn('role_id', [1, 3, 4]);
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

    public function wallet(){
        return $this->hasOne(Wallet::class,'admin_id','id');
    }

}
