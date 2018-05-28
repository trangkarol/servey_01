<?php

namespace App\Repositories\Result;

use App\Models\Result;
use App\Repositories\BaseRepository;
use App\Traits\ClientInformation;
use Exception;
use DB;
use Carbon\Carbon;

class ResultRepository extends BaseRepository implements ResultInterface
{
    use ClientInformation;

    public function getModel()
    {
        return Result::class;
    }

    public function storeResult($data, $survey)
    {
        DB::beginTransaction();

        try {
            $surveyToken = $data->get('survey_token');
            $survey = $survey->where('token', $surveyToken)->first();

            if (!$survey) {
                throw new Exception("Error Processing Request", 1);
            }

            $clientInfo = $this->processAnswererInformation($data, $survey);

            $resultsData = [];
            $sections = $data->get('sections');

            foreach ($sections as $section) {
                $temp = [
                    'question_id' => 0,
                    'answer_id' => 0,
                    'content' => '',
                ];

                foreach ($section['questions'] as $question) {
                    $temp['question_id'] = $question['question_id'];

                    foreach ($question['results'] as $result) {
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

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
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
