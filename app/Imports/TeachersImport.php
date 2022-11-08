<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;

class TeachersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Teacher([
            'status'=>$row[0],
            'name'=>$row[1],
            'nric' =>$row[2],
            'gender' =>$row[3],
            'email' =>$row[4],
            'position' =>$row[5],
            'classlist_id' => $row[6],
            'address' =>$row[7],
            'subject_taught' =>$row[8],
            'phone_number' =>$row[9],
            'image_path' => $row[10],
        ]);
    }
}
