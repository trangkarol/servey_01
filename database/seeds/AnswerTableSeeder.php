<?php

use Illuminate\Database\Seeder;
use App\Models\Answer;

class AnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Answer::truncate();
        factory(Answer::class, 600)->create();
    }
}
