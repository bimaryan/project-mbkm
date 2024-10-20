<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class MahasiswaImport implements ToCollection
{
    /**
     * Handle the collection of data from the Excel file.
     *
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $i = 1;

        foreach ($collection as $row) {
            if ($i > 1) {
                $data['nama'] = !empty($row[0]) ? $row[0] : null;
                $data['nim'] = !empty($row[1]) ? $row[1] : null;
                $data['kelas_id'] = !empty($row[2]) ? $row[2] : 1;
                $data['email'] = !empty($row[3]) ? $row[3] : null;
                $data['password'] = !empty($data['nim']) ? Hash::make('@Poli' . $data['nim']) : null;

                Mahasiswa::create($data);
            }
            $i++;
        }
    }
}
