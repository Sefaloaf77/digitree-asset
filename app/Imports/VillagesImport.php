<?php

namespace App\Imports;

use App\Models\Villages;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VillagesImport implements ToModel, WithHeadingRow
{
    /**
     * Menyimpan data dari Excel ke database
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Villages([
            'name' => $row['name'],
            'kecamatan' => $row['kecamatan'],
            'kab_kota' => $row['kab_kota'],
            'province' => $row['province'],
        ]);
    }
}
