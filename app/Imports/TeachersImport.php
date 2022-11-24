<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
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
        // return new Teacher([
        //     'status'=>$row[0],
        //     'name'=>$row[1],
        //     'nric' =>$row[2],
        //     'gender' =>$row[3],
        //     'email' =>$row[4],
        //     'position' =>$row[5],
        //     'classlist_id' => $row[6],
        //     'address' =>$row[7],
        //     'phone_number' =>$row[8],
        //     'image_path' => $row[9],
        // ]);

        $teacher = new Teacher;
        $teacher->status = $row[0];
        $teacher->name = $row[1];
        $teacher->nric = $row[2];
        $teacher->gender = $row[3];
        $teacher->email = $row[4];
        $teacher->position = $row[5];
        $teacher->classlist_id = $row[6];
        $teacher->address = $row[7];
        $teacher->phone_number = $row[8];
        $teacher->image_path = $row[9];
        $teacher->save();
        
        $user = new User;
        $user->name = $row[1];
        $user->image_path = $row[9];
        $user->email = $row[4];
        $user->type = 1;
        $user->email_verified_at = now();
        $user->password = Hash::make('secret');
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();

    }
}
