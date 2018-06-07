<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSurveySettingRequest extends FormRequest
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
        return [
            'setting.answer_required' => 'required|integer|between:0,2',
            'setting.answer_limited' => 'required|integer|min:0',
            'setting.reminder_email.type' => 'required|integer|between:0,4',
            'setting.reminder_email.next_time' => 'date|after:start_time',
            'setting.privacy' => 'required|integer|between:1,2',
            'invited_email.subject' => 'required',
            'invited_email.send_mail_to_wsm' => 'integer|between:0,1',
            'invited_email.emails.*' => 'email|distinct',
            'members.*.email' => 'email|distinct',
            'members.*.role' => 'integer|in:1',
        ];
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
