<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TempEmployeeSalaryDetailsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   

    public function model(array $row)
    {
        dd($row);
        
    }
}
