<?php

namespace App\Imports;

use App\Models\Merit_Points;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MeritPointsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Merit_Points([
            'category'     => $row['category'],
            'level'    => $row['level'],
            'achievement'    => $row['achievement'],
            'merit_points'    => $row['merit_points'],
        ]);
    }
}
