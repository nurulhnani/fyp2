<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $student = new Student;      
        $student->status = "active";
        $student->name = $row[0];
        $student->mykid = $row[1];
        // $student->classlist_id = $row[3];
        // $student->gender = $row[3];
        // $student->citizenship = $row[4];
        // $student->address = $row[5];
        // $student->G1_name = $row[6];
        // $student->G1_relation = $row[7];
        // $student->G1_phonenum = $row[8];
        // $student->G1_income = $row[9];
        // $student->G2_name = $row[10];
        // $student->G2_relation = $row[11];
        // $student->G2_phonenum = $row[12];
        // $student->G2_income = $row[13];
        // $student->image_path = $row[14];
        $student->save();
        
        $user = new User;
        $user->name = $row[0];
        // $user->image_path = $row[14];
        $user->email = $row[1];
        $user->type = 2;
        $user->email_verified_at = now();
        $user->password = Hash::make('secret');
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();
    }
}
