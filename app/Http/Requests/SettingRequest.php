<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        $rules = [];
        $rules['setting.' . config('settings.key.limitAnswer')] = 'numeric|digits_between:1,' . config('settings.max_limit');
        $rules['setting.' . config('settings.key.tailMail')] = 'max:255
                |regex:/^(@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}[,]{0,1}[,]{0,1}[\s]*)+(?<!,)(?<!\s)$/';

        return $rules;
    }

    public function messages()
    {
        $limit = trans('survey.setting_request.limitAnswer');
        $tailMail = trans('survey.setting_request.tailMail');
        $messages = [];
        $messages['setting.' . config('settings.key.limitAnswer') . '.numeric'] = trans('validation.numeric', [
            'attribute' => $limit,
        ]);
        $messages['setting.' . config('settings.key.limitAnswer') . '.digits_between'] = trans('validation.between.numeric', [
            'attribute' => $limit,
            'min' => 1,
            'max' => config('settings.max_limit'),
        ]);
        $messages['setting.' . config('settings.key.tailMail') . '.max'] = trans('validation.max.string', [
            'attribute' => $tailMail,
            'max' => 255,
        ]);
        $messages['setting.' . config('settings.key.tailMail') . '.regex'] = trans('validation.regex');

        return $messages;
    }
}
