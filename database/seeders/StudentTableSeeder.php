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
        $students = [
            [
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
            ],
            [
                'status'=>'active',
                'name' => 'Nurul Hanani',
                'mykid' => '000729141107',
                'classlist_id' => '1',
                'gender' => 'Female',
                'citizenship' => 'Malaysian',
                'address' => '107, Temerloh',
                'G1_name' => 'Zameri bin Daud',
                'G1_relation' => 'Father',
                'G1_phonenum' => '018555432',
                'G1_income' => '2500',
                'G2_name' => 'Norashkin binti Sarom',
                'G2_relation' => 'Mother',
                'G2_phonenum' => '0198876675',
                'G2_income' => '1500',
                'image_path'=>'Mohd Hafiz bin Kamal.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status'=>'active',
                'name' => 'Nur Amirah',
                'mykid' => '000320011148',
                'classlist_id' => '1',
                'gender' => 'Female',
                'citizenship' => 'Malaysian',
                'address' => '316, Tangkak',
                'G1_name' => 'Noor Mohamed',
                'G1_relation' => 'Father',
                'G1_phonenum' => '0177654423',
                'G1_income' => '5000',
                'G2_name' => 'Azinah',
                'G2_relation' => 'Mother',
                'G2_phonenum' => '0187765678',
                'G2_income' => '3500',
                'image_path'=>'Nur Amirah.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'status'=>'active',
                'name' => 'Aisyah Sofea',
                'mykid' => '000505111103',
                'classlist_id' => '1',
                'gender' => 'Female',
                'citizenship' => 'Malaysian',
                'address' => 'Mentakab Jaya',
                'G1_name' => 'Ghana bin Sarom',
                'G1_relation' => 'Father',
                'G1_phonenum' => '018235435',
                'G1_income' => '1700',
                'G2_name' => 'Hajah binti Bilal',
                'G2_relation' => 'Mother',
                'G2_phonenum' => '0198236675',
                'G2_income' => '1500',
                'image_path'=> null,
                'created_at' => now(),
                'updated_at' => now()
            ]


        ];
        DB::table('students')->insert($students);
    }
}
