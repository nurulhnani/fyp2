<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

  
class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
               'name'=>'Admin Admin',
               'email'=>'admin@argon.com',
               'type'=>0,
               'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'=>'Teacher',
                'email'=>'teacher@argon.com',
                'type'=>1,
                'email_verified_at' => now(),
                 'password' => Hash::make('secret'),
                 'created_at' => now(),
                 'updated_at' => now()
             ],
            [
               'name'=>'Student',
               'email'=>'student@argon.com',
               'type'=>2,
               'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
