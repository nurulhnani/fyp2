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
        $classes = [
            [
                'class_name'=>'1 Amanah',
            ],[
                'class_name'=>'2 Amanah',
            ]
        ];

        DB::table('classlists')->insert($classes);
    }
}
