<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InterestInventorySeeder extends Seeder
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
                'questions'=>'Is he/she active and enjoy sports?',
                'category' => 'Realistic',
            ], [
                'questions'=>'Is he/she good with animals?',
                'category' => 'Realistic',
            ], [
                'questions'=>'Can he/she build and fix things?',
                'category' => 'Realistic',
            ], [
                'questions'=>'Is he/she likes to work outdoors?',
                'category' => 'Realistic',
            ], [
                'questions'=>'Is he/she likes to work with tools?',
                'category' => 'Realistic',
            ], [
                'questions'=>'Is he/she the one who always asks questions?',
                'category' => 'Investigative',
            ], [
                'questions'=>'Is he/she likes Science?',
                'category' => 'Investigative',
            ], [
                'questions'=>'Can he/she solves math problems?',
                'category' => 'Investigative',
            ], [
                'questions'=>'Can he/she use facts to answer questions?',
                'category' => 'Investigative',
            ], [
                'questions'=>'Is he/she likes to work alone?',
                'category' => 'Investigative',
            ], [
                'questions'=>'Is he/she able to imagine new things?',
                'category' => 'Artistic',
            ], [
                'questions'=>'Is he/she able to think of new ideas?',
                'category' => 'Artistic',
            ], [
                'questions'=>'Can he/she sketch, draw or paint?',
                'category' => 'Artistic',
            ], [
                'questions'=>'Can he/she plays a musical instrument?',
                'category' => 'Artistic',
            ], [
                'questions'=>'Can he/she writes stories, sing, act, or dance?',
                'category' => 'Artistic',
            ], [
                'questions'=>'Is he/she friendly?',
                'category' => 'Social',
            ], [
                'questions'=>'Is he/she helpful?',
                'category' => 'Social',
            ], [
                'questions'=>'Can he/she coorporates with friends/teachers?',
                'category' => 'Social',
            ], [
                'questions'=>'Can he/she plans an activity?',
                'category' => 'Social',
            ], [
                'questions'=>'Can he/she plays team sports?',
                'category' => 'Social',
            ], [
                'questions'=>'Is he/she confident?',
                'category' => 'Enterprising',
            ], [
                'questions'=>'Is he/she able to argue with his/her opinion?',
                'category' => 'Enterprising',
            ], [
                'questions'=>'Can he/she talk confidently to people?',
                'category' => 'Enterprising',
            ], [
                'questions'=>'Is he/she likes to sell things?',
                'category' => 'Enterprising',
            ], [
                'questions'=>'Is he/she likes to win or achieve any prize/award?',
                'category' => 'Enterprising',
            ], [
                'questions'=>'Is he/she always neat and clean?',
                'category' => 'Conventional',
            ], [
                'questions'=>'Is he/she always careful to do things right?',
                'category' => 'Conventional',
            ], [
                'questions'=>'Can he/she follow school rules?',
                'category' => 'Conventional',
            ], [
                'questions'=>'Can he/she write letters?',
                'category' => 'Conventional',
            ], [
                'questions'=>'Is he/she likes to use computers?',
                'category' => 'Conventional',
            ],

        ];
        DB::table('interest_inventory')->insert($questions);
    }
}
