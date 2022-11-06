<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'status'=>'active',
            'name' => 'Mohd Hafiz bin Kamal',
            'mykid' => 'MH12123',
            'classlist_id' => '1',
            'gender' => 'Male',
            'citizenship' => 'Malaysian',
            'address' => '22, Kampung Baru',
            'G1_name' => 'Kamal bin Daud',
            'G1_relation' => 'Father',
            'G1_phonenum' => '0185526354',
            'G1_income' => '2500',
            'G2_name' => 'Hamidah binti Wahab',
            'G2_relation' => 'Mother',
            'G2_phonenum' => '0198876675',
            'G2_income' => '1500',
            'image_path'=>'Mohd Hafiz bin Kamal.png',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
