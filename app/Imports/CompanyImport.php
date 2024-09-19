<?php

namespace App\Imports;

use App\Models\Temp_companydetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;


class CompanyImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Start database transaction
        DB::beginTransaction();
    
        try {
            // Insert data into TempCompanyDetails
            Temp_companydetail::create([
                'company_name' => $row['company_name'],
                'type' => $row['type'],
                'owner_name' => $row['owner_name'],
                'contact_no' => $row['contact_no'],
                'city' => $row['city'], // Store city name as provided in Excel
                'distt' => $row['distt'], // Store district name as provided in Excel
                'state' => $row['state'], // Store state name as provided in Excel
                'address' => $row['address'],
                'gst_no' => $row['gst_no'],
                'pan_no' => $row['pan_no'],
                'aadhar_no' => $row['aadhar_no'],
                'udyam_no' => $row['udyam_no'],
                'cin_no' => $row['cin_no'],
                'epf_no' => $row['epf_no'],
                'esic_no' => $row['esic_no'],
                'bank_name' => $row['bank_name'],
                'ac_no' => $row['ac_no'],
                'ifs_code' => $row['ifs_code'],
            ]);
    
            DB::commit(); // Commit transaction on success
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction on error
            // You can log the error or handle it as needed
            Log::error('Error importing company details: ' . $e->getMessage());
        }
    
        return null;
    }
    
}
