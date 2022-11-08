<?php

namespace App\Imports;

// use App\Models\Merit;
// use Maatwebsite\Excel\Concerns\ToModel;

// class MeritsImport implements ToModel
// {
//     /**
//     * @param array $row
//     *
//     * @return \Illuminate\Database\Eloquent\Model|null
//     */
//     public function model(array $row)
//     {
//         return new Merit([
//             // 'name'     => $row[0],
//             'student_mykid' => $row[1]
//         ]);
//     }
// }

use App\Models\Merit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MeritsImport implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows)
    {
        // foreach ($rows as $row) 
        // {
        //     Merit::create([
        //         'name' => $row[0],
        //         'student_mykid' => $row[1]
        //     ]);
        // }
    }
}
