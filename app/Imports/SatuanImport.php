<?php

namespace App\Imports;

use App\Models\Satuan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SatuanImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Satuan::create([
               'satuan' => $row['satuan'],
            ]);
        }
    }
}
