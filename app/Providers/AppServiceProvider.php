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
use App\Repositories\Like\LikeInterface;
use App\Repositories\Like\LikeRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
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
        App::bind(LikeInterface::class, LikeRepository::class);
    }
}
