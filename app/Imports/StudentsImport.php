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
        // return new Student([
        //     'status'=>$row[0],
        //     'name' => $row[1],
        //     'mykid' => $row[2],
        //     'classlist_id' => $row[3],
        //     'gender' => $row[4],
        //     'citizenship' => $row[5],
        //     'address' => $row[6],
        //     'G1_name' => $row[7],
        //     'G1_relation' => $row[8],
        //     'G1_phonenum' => $row[9],
        //     'G1_income' => $row[10],
        //     'G2_name' => $row[11],
        //     'G2_relation' => $row[12],
        //     'G2_phonenum' => $row[13],
        //     'G2_income' => $row[14],
        //     'image_path'=>$row[15],
        // ]);
        $student = new Student;      
        $student->status = $row[0];
        $student->name = $row[1];
        $student->mykid = $row[2];
        // $student->classlist_id = $row[3];
        $student->gender = $row[3];
        $student->citizenship = $row[4];
        $student->address = $row[5];
        $student->G1_name = $row[6];
        $student->G1_relation = $row[7];
        $student->G1_phonenum = $row[8];
        $student->G1_income = $row[9];
        $student->G2_name = $row[10];
        $student->G2_relation = $row[11];
        $student->G2_phonenum = $row[12];
        $student->G2_income = $row[13];
        $student->image_path = $row[14];
        $student->save();
        
        // return new User([
        //     'name' => $row[1],
        //     'image_path' => $row[15],
        //     'email' => $row[2],
        //     'type' => 2,
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('secret'),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        $user = new User;
        $user->name = $row[1];
        $user->image_path = $row[14];
        $user->email = $row[2];
        $user->type = 2;
        $user->email_verified_at = now();
        $user->password = Hash::make('secret');
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();
    }
}
