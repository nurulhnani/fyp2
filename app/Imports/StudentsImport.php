<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            'status'=>$row[0],
            'name' => $row[1],
            'mykid' => $row[2],
            'classlist_id' => $row[3],
            'gender' => $row[4],
            'citizenship' => $row[5],
            'address' => $row[6],
            'G1_name' => $row[7],
            'G1_relation' => $row[8],
            'G1_phonenum' => $row[9],
            'G1_income' => $row[10],
            'G2_name' => $row[11],
            'G2_relation' => $row[12],
            'G2_phonenum' => $row[13],
            'G2_income' => $row[14],
            'image_path'=>$row[15],
        ]);
    }
}
