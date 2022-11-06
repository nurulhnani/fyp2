<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name' => 'Hanani',
            'mykid' => '000729141107',
            'class' => '5 Bestari',
            'gender' => 'Female',
            'citizenship' => 'Malaysian',
            'address' => 'Temerloh Jaya',
            'G1_name' => 'Zameri',
            'G1_relation' => 'Father',
            'G1_phonenum' => '0192035237',
            'G1_income' => '2000',
            'G2_name' => 'Norashikin',
            'G2_relation' => 'Mother',
            'G2_phonenum' => '0138441974',
            'G2_income' => '2000',
            'created_at' => now(),
            'updated_at' => now()
        ]);    
    }
}
