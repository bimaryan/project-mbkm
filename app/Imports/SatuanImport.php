<?php

namespace App\Imports;

use App\Models\Satuan;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SatuanImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Satuan::create([
               'satuan' => $row['satuan'],
            ]);
        }
    }
}
