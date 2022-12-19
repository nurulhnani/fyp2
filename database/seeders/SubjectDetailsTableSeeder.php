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
        DB::table('subject_details')->insert(
            [
                'subject_id'=> '1',
                'classlist_id'=> '1',
                'teacher_id'=> '1'
            ],[
                'subject_id'=> '2',
                'classlist_id'=> '2',
                'teacher_id'=> '2'
            ]
        );
    }
}
