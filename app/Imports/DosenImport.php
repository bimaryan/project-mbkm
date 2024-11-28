<?php

namespace App\Imports;

use App\Models\Dosen;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Dosen([
            'nama' => $row['nama'],
            'nip'=> $row['nip'],
            'username'=> $row['username'],
            'password' => Hash::make('polindra')
        ]);
    }
}
