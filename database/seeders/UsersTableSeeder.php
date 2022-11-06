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
