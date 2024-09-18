<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminDetail extends Model
{
    use HasFactory;
    protected $table = 'admin_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id',
        'type',
        'owner_name',
        'address',
        'city','city_id', 'state_id', 'district_id',
        'distt',
        'state',
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'admin_id' => 'integer',
        'gst_no' => 'string',
        'pan_no' => 'string',
        'aadhar_no' => 'string',
        'udyam_no' => 'string',
        'cin_no' => 'string',
        'epf_no' => 'string',
        'esic_no' => 'string',
        'bank_name' => 'string',
        'ac_no' => 'string',
        'ifs_code' => 'string',
        'address' => 'string',
        'city' => 'string',
        'distt' => 'string',
        'state' => 'string',
        'type' => 'string',
        'owner_name' => 'string',
    ];

    /**
     * Get the admin that owns the details.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
