<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
    use HasFactory;
    protected $table = 'fees_payments'; // Specify the table name

    // Define fillable fields to enable mass assignment
    protected $fillable = [
        'company_id',
        'month',
        'year',
        'fee_amount',
        'payment_type','doc_no'
    ];

    // Define relationship with the company (admin)
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
