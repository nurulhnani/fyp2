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
                'merit_point' => '-10',
                'student_mykid' => '000729141107',
                'merit_name' => 'Vape',
                'level' => 'High',
                'achievement' => '-',
                'desc' => 'test',
                'date' => Carbon::parse('2023-05-11'),
                'created_at' => now(),
                'updated_at' => now()
            ], [
                'type' => 'b',
                'merit_point' => '20',
                'student_mykid' => '000320011148',
                'merit_name' => 'Donate',
                'level' => 'Medium',
                'achievement' => '-',
                'desc' => 'test',
                'date' => Carbon::parse('2023-01-01'),
                'created_at' => now(),
                'updated_at' => now()
            ]

        ];
        // DB::table('merits')->insert($merits);
        $faker = Faker::create();
    	foreach (range(1,10) as $index) {
            DB::table('merits')->insert([
                'type' => $faker->randomElement(['b', 'c']),
                'merit_point' => $faker->numberBetween(-30, 30),
                'student_mykid' => $faker->randomElement(['000729141107', '000505111103','MH12123']),
                'merit_name' => $faker->name,
                'level' => $faker->randomElement(['Medium', 'High', 'Low']),
                'achievement' => '-',
                'desc' => $faker->text,
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
