<?php

namespace Database\Seeders;

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
        DB::table('teachers')->insert([
            'status'=>'active',
            'name'=>'Sabarina binti Kamal',
            'nric' =>'890716-01-2236',
            'gender' =>'Female',
            'email' =>'sabarina@gmail.com',
            'position' =>'Classroom teacher',
            'classlist_id' => '1',
            'address' =>'34, Jalan Bahagia, Selangor',
            'subject_taught' =>'Mathematics Grade 1',
            'phone_number' =>'0198872436',
            'image_path' => 'Sabarina binti Kamal.png',
        ]);
    }
}
