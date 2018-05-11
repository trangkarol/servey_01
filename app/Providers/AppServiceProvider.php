<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App;
use App\Repositories\Survey\SurveyInterface;
use App\Repositories\Question\QuestionInterface;
use App\Repositories\Answer\AnswerInterface;
use App\Repositories\Survey\SurveyRepository;
use App\Repositories\Question\QuestionRepository;
use App\Repositories\Answer\AnswerRepository;
use App\Repositories\Result\ResultInterface;
use App\Repositories\Result\ResultRepository;
use App\Repositories\Invite\InviteInterface;
use App\Repositories\Invite\InviteRepository;
use App\Repositories\Setting\SettingInterface;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\Section\SectionInterface;
use App\Repositories\Section\SectionRepository;
use App\Repositories\Feedback\FeedbackInterface;
use App\Repositories\Feedback\FeedbackRepository;
use App\Repositories\Media\MediaInterface;
use App\Repositories\Media\MediaRepository;
use Blade;
use Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Session::put('locale', 'vn');
        Blade::extend(function($value, $compiler){
            $value = preg_replace('/(\s*)@switch\((.*)\)(?=\s)/', '$1<?php switch($2):', $value);
            $value = preg_replace('/(\s*)@endswitch(?=\s)/', '$1endswitch; ?>', $value);
            $value = preg_replace('/(\s*)@case\((.*)\)(?=\s)/', '$1case $2: ?>', $value);
            $value = preg_replace('/(?<=\s)@default(?=\s)/', 'default: ?>', $value);
            $value = preg_replace('/(?<=\s)@breakswitch(?=\s)/', '<?php break;', $value);

            return $value;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(UserInterface::class, UserRepository::class);
        App::bind(SurveyInterface::class, SurveyRepository::class);
        App::bind(AnswerInterface::class, AnswerRepository::class);
        App::bind(QuestionInterface::class, QuestionRepository::class);
        App::bind(ResultInterface::class, ResultRepository::class);
        App::bind(InviteInterface::class, InviteRepository::class);
        App::bind(SettingInterface::class, SettingRepository::class);
        App::bind(FeedbackInterface::class, FeedbackRepository::class);
        App::bind(SectionInterface::class, SectionRepository::class);
        App::bind(MediaInterface::class, MediaRepository::class);
    }
}
