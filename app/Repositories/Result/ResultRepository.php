<?php

namespace App\Repositories\Result;

use App\Models\Result;
use App\Repositories\BaseRepository;
use App\Traits\ClientInformation;
use Exception;
use DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class ResultRepository extends BaseRepository implements ResultInterface
{
    use ClientInformation;

    public function getModel()
    {
        return Result::class;
    }

    public function storeResult($data, $survey)
    {
        $surveyToken = $data->get('survey_token');
        $survey = $survey->getSurveyFromToken($surveyToken);

        $clientInfo = $this->processAnswererInformation($data, $survey, $survey->getPrivacy());

        $resultsData = [];
        $sections = $data->get('sections');

        foreach ($sections as $section) {
            $temp = [];

            foreach ($section['questions'] as $question) {
                $temp['question_id'] = $question['question_id'];

                foreach ($question['results'] as $result) {
                    $temp['answer_id'] = 0;

                    if (in_array($question['type'], [
                        config('settings.question_type.short_answer'),
                        config('settings.question_type.long_answer'),
                        config('settings.question_type.date'),
                        config('settings.question_type.time'),
                    ])) {
                        $temp['content'] = $result['content'];
                    } elseif ($result['answer_id']) {
                        $temp['answer_id'] = $result['answer_id'];

                        if ($result['answer_type'] == config('settings.answer_type.other_option')) {
                            $temp['content'] = $result['content'];
                        }
                    }

                    array_push($resultsData, array_merge($temp, $clientInfo));
                }
            }
        }

        $survey->results()->createMany($resultsData);
    }

    // === old ===
    public function create($answers)
    {
        $input = [];
        foreach ($answers as $answer) {
            $input[] = [
                'sender_id' => $senderId,
                'recever_id' => $receverId,
                'answer_id' => $answer->id,
            ];
        }

        $this->multiCreate($input);
    }

    public function getDetailResultSurvey($request, $survey)
    {
        $results = $survey->results->groupBy(
            function($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d H:m:s');
            }
        );

        $countResult = $results->count();
        $page = isset($request->page) ? $request->page : 1;
        $perPage = 1;

        $paginate = new LengthAwarePaginator(
            $results->forPage($page, $perPage),
            $results->count(),
            $perPage,
            $page,
            ['path' => route('survey.result.detail-result', $survey->token_manage)]
        );

        return [
            'results' => $paginate,
            'countResult' => $countResult,
        ];
    }

    public function closeFromSurvey($survey)
    {
        return $survey->results()->delete();
    }

    public function openFromSurvey($survey)
    {
        return $survey->results()->onlyTrashed()->restore();
    }

    public function deleteFromSurvey($survey)
    {
        return $survey->results()->withTrashed()->forceDelete();
    }
}
