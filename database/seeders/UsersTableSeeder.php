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
               'nric_mykid'=>'admin@mescore.com',
               'type'=>0,
               'first_login' => 1,
               'logincount' => 0,
               'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'=>'Teacher',
                'image_path' => 'teacher.png',
                'nric_mykid'=>'teacher@mescore.com',
                'type'=>1,
                'first_login' => 1,
                'logincount' => 0,
                'email_verified_at' => now(),
                 'password' => Hash::make('secret'),
                 'created_at' => now(),
                 'updated_at' => now()
             ],
            [
               'name'=>'Student',
               'image_path' => 'student.png',
               'nric_mykid'=>'student@mescore.com',
               'type'=>2,
               'first_login' => 1,
               'logincount' => 0,
               'email_verified_at' => now(),
                'password' => Hash::make('secret'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'=>'Sabarina binti Kamal',
                'image_path' => 'Sabarina binti Kamal.png',
                'nric_mykid'=>'890716-01-2236',
                'type'=>1,
                'email_verified_at' => now(),
                'first_login' => 1,
                'logincount' => 0,
                 'password' => Hash::make('secret'),
                 'created_at' => now(),
                 'updated_at' => now()
             ],
             [
                'name'=>'Mohd Ridwan bin Daud',
                'image_path' => 'Mohd Ridwan bin Daud.png',
                'nric_mykid'=>'890721-14-2231',
                'type'=>1,
                'email_verified_at' => now(),
                'first_login' => 1,
                'logincount' => 0,
                 'password' => Hash::make('secret'),
                 'created_at' => now(),
                 'updated_at' => now()
             ],
            [
                'name'=>'Mohd Hafiz bin Kamal',
                'image_path' => 'Mohd Hafiz bin Kamal.png',
                'nric_mykid'=>'MH12123',
                'type'=>2,
                'first_login' => 1,
                'logincount' => 0,
                'email_verified_at' => now(),
                 'password' => Hash::make('secret'),
                 'created_at' => now(),
                 'updated_at' => now()
            ],[
                'name'=>'Nurul Hanani',
                'image_path' => 'Nurul Hanani.png',
                'nric_mykid'=>'000729141107',
                'type'=>2,
                'first_login' => 1,
                'logincount' => 0,
                'email_verified_at' => now(),
                 'password' => Hash::make('secret'),
                 'created_at' => now(),
                 'updated_at' => now()
            ],[
                'name'=>'Nur Amirah',
                'image_path' => 'Nurul Amirah.png',
                'nric_mykid'=>'000320011148',
                'email'=>'nuramiramohamed20@gmail.com',
                'type'=>2,
                'first_login' => 0,
                'logincount' => 0,
                'email_verified_at' => now(),
                 'password' => Hash::make('secret'),
                 'created_at' => now(),
                 'updated_at' => now()
            ]
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
