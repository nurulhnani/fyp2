<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubjectDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subject_details')->insert([
            'subject_id'=> '1',
            'class_name'=> '1 Amanah',
            'subject_teacher'=> 'Nor Sabarina'
        ]);
    }
}
