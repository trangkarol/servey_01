<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SurveyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|max:255',
            'start_time' => 'date',
            'end_time' => 'date|after:start_time',
            'setting.answer_required' => 'required|integer|between:0,2',
            'setting.answer_limited' => 'required|integer|min:0',
            'setting.reminder_email.type' => 'required|integer|between:0,4',
            'setting.reminder_email.next_time' => 'date|after:start_time',
            'setting.privacy' => 'required|integer|boolean',
            'invited_email.subject' => 'required',
            'invited_email.send_mail_to_wsm' => 'required|integer|between:0,1',
            'invited_email.emails.*' => 'email|distinct',
            'members.*.email' => 'email|distinct',
            'members.*.role' => 'integer|in:1',
            'sections.*.title' => 'required|distinct',
            'sections.*.questions.*.title' => 'required|distinct',
            'sections.*.questions.*.type' => 'required|integer|between:1,9',
            'sections.*.questions.*.require' => 'required|boolean',
            'sections.*.questions.*.answers.*.type' => 'required|integer|between:1,2',
        ];

        // validation rules distinct answer in question
        $sections = $this->json()->get('sections');
        foreach ($sections as $sectionIndex => $sectionVal) {
            foreach ($sections[$sectionIndex]['questions'] as $questionIndex => $questionVal) {
                $rules['sections.' . $sectionIndex . '.questions.' . $questionIndex . '.answers.*.content'] = 'required|distinct'; 
            }
        }

        return $rules;
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->json()->all();
    }
}
