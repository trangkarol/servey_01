<?php

namespace App\Http\Middleware;

use Closure;
use App\Repositories\Survey\SurveyInterface;
use Auth;
use Illuminate\Http\Response;

class DoingSurveyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $surveyRepository;

    public function __construct(SurveyInterface $surveyRepository)
    {
        $this->surveyRepository = $surveyRepository;
    }

    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            $survey = $this->surveyRepository->getSurveyFromToken($request->token);
            $requiredLogin = $survey->required;
            $privacy = $survey->getPrivacy();

            if ($privacy == config('settings.survey_setting.privacy.private')) {
                $requiredLogin = config('settings.survey_setting.answer_required.login');
            }

            if ($requiredLogin) {
                return new Response(view('clients.survey.detail.index', compact('requiredLogin')));
            }
        }

        return $next($request);
    }
}
