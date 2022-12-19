<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
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
               'image_path' => 'logosekolah.png',
               'email'=>'admin@argon.com',
               'type'=>0,
               'first_login' => 1,
               'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'=>'Teacher',
                'image_path' => 'teacher.png',
                'email'=>'teacher@argon.com',
                'type'=>1,
                'first_login' => 1,
                'email_verified_at' => now(),
                 'password' => Hash::make('secret'),
                 'created_at' => now(),
                 'updated_at' => now()
             ],
            [
               'name'=>'Student',
               'image_path' => 'student.png',
               'email'=>'student@argon.com',
               'type'=>2,
               'first_login' => 1,
               'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'=>'Sabarina binti Kamal',
                'image_path' => 'Sabarina binti Kamal.png',
                'email'=>'sabarina@gmail.com',
                'type'=>1,
                'email_verified_at' => now(),
                'first_login' => 1,
                 'password' => Hash::make('secret'),
                 'created_at' => now(),
                 'updated_at' => now()
             ],
             [
                'name'=>'Mohd Ridwan bin Daud',
                'image_path' => 'Mohd Ridwan bin Daud.png',
                'email'=>'ridwan@gmail.com',
                'type'=>1,
                'email_verified_at' => now(),
                'first_login' => 1,
                 'password' => Hash::make('secret'),
                 'created_at' => now(),
                 'updated_at' => now()
             ],
            [
                'name'=>'Mohd Hafiz bin Kamal',
                'image_path' => 'Mohd Hafiz bin Kamal.png',
                'email'=>'MH12123',
                'type'=>2,
                'first_login' => 1,
                'email_verified_at' => now(),
                 'password' => Hash::make('secret'),
                 'created_at' => now(),
                 'updated_at' => now()
            ],[
                'name'=>'Nurul Hanani',
                'image_path' => 'Nurul Hanani.png',
                'email'=>'000729141107',
                'type'=>2,
                'first_login' => 1,
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
