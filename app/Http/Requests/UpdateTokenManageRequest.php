<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTokenManageRequest extends FormRequest
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
            'token_manage' => 'required|string|unique:surveys|max:100',
        ];
    }

    public function messages()
    {
        return [
            'token_manage.unique' => trans('lang.token_manage_is_already_used'),
            'token_manage.required' => trans('lang.token_manage_is_required'),
            'token_manage.max' => trans('lang.token_manage_is_too_long', ['number' => 100]),
        ];
    }
}
