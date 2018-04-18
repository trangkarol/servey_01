<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Survey;
use App\Models\Invite;
use App\Models\Section;
use App\Models\Question;
use App\Models\Answer;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        User::truncate();
        factory(User::class)->create([
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
        ]);

        factory(User::class)->create([
            'email' => 'supperadmin@gmail.com',
            'name' => 'Supper Admin',
        ]);
        
        factory(User::class, 10)->create()->each(function ($user) use ($faker) {
            $survey = factory(Survey::class)->create();

            // create settings
            $survey->settings()->createMany($this->getKeySetting());

            // create owner
            $survey->members()->attach($user->id, [
                'role' => config('settings.survey.members.owner'),
                'status' => config('settings.survey.members.status.approve'),
            ]);

            //create invites mail
            $survey->invites()->create([
                'invite_mails' => $this->getEmailOfUser($user),
                'answer_mails' => '',
                'status' => config('settings.survey.invite_status.not_finish'),
            ]);

            // create sections
            factory(Section::class, 3)->create([
                'survey_id' => $survey->id,
            ])->each(function ($section) use ($faker) {
                factory(Question::class, 3)->create([
                    'section_id' => $section->id,
                ])->each(function ($question) use ($faker) {
                    $settings = $question->settings()->create([
                        'key' => $faker->numberBetween(1, 9),
                        'value' => config('settings.setting_type.question_type.key'),
                    ]);

                    if (in_array($settings->key, [
                        config('settings.question_type.short_answer'),
                        config('settings.question_type.long_answer'),
                        config('settings.question_type.multiple_choice'),
                        config('settings.question_type.checkboxes'),
                    ])) {

                        factory(Answer::class, 3)->create([
                            'question_id' => $question->id,
                        ]);
                    }
                });
            });
        });
    }

    public function getEmailOfUser($user)
    {
        $emails = User::where('id', '!=', $user->id)->pluck('email')->all();
        $listMails = '';

        foreach ($emails as $email) {
            $listMails .= $email . '/';
        }

        return $listMails;
    }

    public function getKeySetting()
    {
        $keySettings =  [
            config('settings.setting_type.answer_required.key'),
            config('settings.setting_type.answer_limited.key'),
            config('settings.setting_type.reminder_email.key'),
            config('settings.setting_type.privacy.key'),
        ];

        $settings = [];

        foreach ($keySettings as $value) {
            $settings[] = [
                'key' => $value,
                'value' => $this->getValue($value),
            ];
        }

        return $settings;
    }

    public function getValue($value)
    {
        $faker = Faker\Factory::create();

        switch ($value) {
            case config('settings.setting_type.answer_required.key'):
                return $faker->numberBetween(0, 2);
            case config('settings.setting_type.answer_limited.key'):
                return $faker->numberBetween(1, 10);
            case config('settings.setting_type.privacy.key'):
                return $faker->numberBetween(0, 1);
            case config('settings.setting_type.reminder_email.key'):
                return $faker->numberBetween(0, 3);
            
            default:
                break;
        }
    }
}
