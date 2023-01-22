<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class MeritsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $merits = [
            [
                'type' => 'c',
                'category' => 'Competition',
                'merit_point' => '10',
                'student_mykid' => '000729141107',
                'merit_name' => 'Volunteering',
                'level' => 'School',
                'achievement' => 'Participant',
                'desc' => 'test',
                'date' => Carbon::parse('2023-01-01'),
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'type' => 'c',
                'category' => 'Competition',
                'merit_point' => '10',
                'student_mykid' => '000505111103',
                'merit_name' => 'Merentas Desa',
                'level' => 'School',
                'achievement' => 'Committee Member',
                'desc' => 'test',
                'date' => Carbon::parse('2023-04-14'),
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'type' => 'b',
                'category' => null,
                'merit_point' => '-10',
                'student_mykid' => '000729141107',
                'merit_name' => 'Vape',
                'level' => 'High',
                'achievement' => null,
                'desc' => 'test',
                'date' => Carbon::parse('2023-05-11'),
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'type' => 'b',
                'category' => null,
                'merit_point' => '20',
                'student_mykid' => '000320011148',
                'merit_name' => 'Donate',
                'level' => 'Medium',
                'achievement' => null,
                'desc' => 'test',
                'date' => Carbon::parse('2023-01-01'),
                'created_at' => now(),
                'updated_at' => now()
            ]

        ];
        DB::table('merits')->insert($merits);
    }
}
