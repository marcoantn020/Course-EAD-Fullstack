<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            CourseSeeder::class,
            ModuleSeeder::class,
            LessonSeeder::class,
            UserSeeder::class,
            SupportSeeder::class,
            ReplySupportSeeder::class
        ]);
    }
}
