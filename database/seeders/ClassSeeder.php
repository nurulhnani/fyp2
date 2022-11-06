<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classlists')->insert([
            'class_name'=>'1 Amanah',
            // 'student_id'=>'1',
            'femaleStudent' => 8,
            'maleStudent' => 12,
            'classroom_teacher' => 'Sabarina binti Kamal'
        ]);
    }
}
