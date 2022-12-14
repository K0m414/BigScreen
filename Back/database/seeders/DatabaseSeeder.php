<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // call seeders
        $this->call(UserTableSeeder::class);
        $this->call(SurveyTableSeeder::class);
        $this->call(QuestionTableSeeder::class);
    }
}
