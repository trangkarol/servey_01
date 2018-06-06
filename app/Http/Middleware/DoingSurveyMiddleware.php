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
        $survey = $this->surveyRepository->getSurveyFromToken($request->token);
        $requiredLogin = $survey->settings
            ->where('key', config('settings.setting_type.answer_required.key'))
            ->first()
            ->value;

        if ($requiredLogin && !Auth::check()) {
            return new Response(view('clients.survey.detail.index', compact('requiredLogin')));
        }

        return $next($request);
    }
}
