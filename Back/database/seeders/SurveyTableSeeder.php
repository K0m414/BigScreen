<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Survey;

class SurveyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create data into survey table
        Survey::create([
            'name' => 'Sondage de satisfaction',
            'created_at' => now(),
            'updated_at' => now(),        
        ]);
    }
}
