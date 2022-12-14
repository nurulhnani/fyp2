<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
            [
                'status'=>'active',
                'name'=>'Sabarina binti Kamal',
                'nric' =>'890716-01-2236',
                'gender' =>'Female',
                'email' =>'sabarina@gmail.com',
                'position' =>'Classroom teacher',
                'classlist_id' => null,
                'address' =>'34, Jalan Bahagia, Selangor',
                'phone_number' =>'0198872436',
                'image_path' => 'Sabarina binti Kamal.png',
            ],[
                'status'=>'active',
                'name'=>'Mohd Ridwan bin Daud',
                'nric' =>'890721-14-2231',
                'gender' =>'Male',
                'email' =>'ridwan@gmail.com',
                'position' =>'Classroom teacher',
                'classlist_id' => null,
                'address' =>'3, Jalan Sentosa, Selangor',
                'phone_number' =>'0176523422',
                'image_path' => 'Mohd Ridwan bin Daud.png',
            ]
        ];
        
        foreach ($teachers as $key => $teacher) {
            Teacher::create($teacher);
        }
        
    }
}
