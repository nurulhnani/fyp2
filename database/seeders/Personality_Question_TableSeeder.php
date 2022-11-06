<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Personality_Question_TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [
                'question' => 'Student participation in class',
                'type' => 's',
                'created_at' => now(),
                'updated_at' => now()
            ], ['question' => 'Student involvement in group project',
                'type' => 's',
                'created_at' => now(),
                'updated_at' => now()
            ]

        ];
        DB::table('personality_questions')->insert($questions); 
    }
}
