<?php

use Illuminate\Database\Seeder;
use App\Models\Survey;
use App\Models\Invite;
use App\Models\Section;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Setting;
use App\Models\Media;
use App\Models\Feedback;
use DB;

class CleansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Invite::truncate();
        Feedback::truncate();
        Setting::truncate();
        Media::truncate();
        Result::truncate();
        Answer::truncate();
        Question::truncate();
        Section::truncate();
        DB::table('members')->truncate();
        Survey::truncate();
    }
}
