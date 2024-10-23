<?php

namespace App\Imports;

use App\Models\Room;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class RuanganImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $i = 1;

        foreach ($collection as $row) {
            if ($i > 1) {
                $data['nama_ruangan'] = !empty($row[0]) ? $row[0] : '';
                Room::create($data);
            }
            $i++;
        }
    }
}
