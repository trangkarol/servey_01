<?php

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
        Survey::truncate();
        factory(Survey::class, 20)->create();
    }
}
