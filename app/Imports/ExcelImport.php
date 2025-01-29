<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas; 

class ExcelImport implements ToCollection , WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
     
    public function collection(Collection $collections)
    {
        return $collections;
    }

    public function headingRow(): int
    {
        return 2;
    }

}
