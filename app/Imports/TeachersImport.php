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
        $teacher->status = "active";
        $teacher->name = $row[0];
        $teacher->nric = $row[1];
        // $teacher->gender = $row[3];
        $teacher->email = $row[2];
        // $teacher->position = $row[5];
        // $teacher->classlist_id = null;
        // $teacher->address = $row[6];
        // $teacher->phone_number = $row[7];
        // $teacher->image_path = $row[8];
        $teacher->save();
        
        $user = new User;
        $user->name = $row[0];
        // $user->image_path = $row[8];
        $user->email = $row[2];
        $user->type = 1;
        $user->email_verified_at = now();
        $user->password = Hash::make('secret');
        $user->created_at = now();
        $user->updated_at = now();
        $user->save();

    }
}
