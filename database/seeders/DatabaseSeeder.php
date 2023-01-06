<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ClassSeeder::class,
            StudentTableSeeder::class,  
            TeacherTableSeeder::class, 
            SubjectTableSeeder::class,
            SubjectDetailsTableSeeder::class,
            MeritsTableSeeder::class,
            Personality_Question_TableSeeder::class,
            InterestInventorySeeder::class,
            LoginCountTableSeeder::class,
            HealthTableSeeder::class]);
    }
}
