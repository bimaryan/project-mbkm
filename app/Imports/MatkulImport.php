<?php

namespace App\Imports;

use App\Models\MataKuliah;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MatkulImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $i = 1;

        foreach ($collection as $row) {
            if ($i > 1) {
                $data['kode_mata_kuliah'] = !empty($row[1]) ? $row[1] : '';
                $data['mata_kuliah'] = !empty($row[2]) ? $row[2] : '';
                MataKuliah::create($data);
            }
            $i++;
        }
    }
}
