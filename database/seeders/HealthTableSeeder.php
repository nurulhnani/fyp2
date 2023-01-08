<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class HealthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $healths = [
        //     [
        //         'student_id'=>'1',
        //         'height'=>'138cm',
        //         'weight'=>'38kg',
        //         'health_history'=>'Asthma,Back Injuries',
        //         'description'=>null,
        //         'medication_allergies'=>null,
        //         'medications_now_taking'=>null,
        //         'chicken_pox'=>'Had, Immunized',
        //         'measles'=>null,
        //         'mumps'=>null,
        //         'present_health'=>'Good'
        //     ],
        // ];
        // DB::table('healths')->insert($healths);
    }
}
