<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LoginCountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logins = [
            [
                'user_id'=>'4',
                'created_at'=> '2021-10-23 16:09:24',
                'updated_at'=>'2021-10-23 16:09:24'
            ],[
                'user_id'=>'4',
                'created_at'=> '2022-11-23 16:09:24',
                'updated_at'=>'2022-10-23 16:09:24'
            ],[
                'user_id'=>'4',
                'created_at'=> '2022-11-22 16:09:24',
                'updated_at'=>'2022-10-22 16:09:24'
            ],[
                'user_id'=>'4',
                'created_at'=> '2022-12-23 16:09:24',
                'updated_at'=>'2022-12-23 16:09:24'
            ],[
                'user_id'=>'7',
                'created_at'=> '2022-10-23 16:09:24',
                'updated_at'=>'2022-10-23 16:09:24'
            ],[
                'user_id'=>'7',
                'created_at'=> '2022-10-25 16:09:24',
                'updated_at'=>'2022-10-25 16:09:24'
            ],[
                'user_id'=>'7',
                'created_at'=> '2022-11-23 16:09:24',
                'updated_at'=>'2022-11-23 16:09:24'
            ],[
                'user_id'=>'7',
                'created_at'=> '2022-12-23 16:09:24',
                'updated_at'=>'2022-12-23 16:09:24'
            ],[
                'user_id'=>'7',
                'created_at'=> '2022-12-26 16:09:24',
                'updated_at'=>'2022-12-26 16:09:24'
            ],[
                'user_id'=>'7',
                'created_at'=> '2022-12-27 16:09:24',
                'updated_at'=>'2022-12-27 16:09:24'
            ]
        ];

        DB::table('login_count')->insert($logins);
    }
}
