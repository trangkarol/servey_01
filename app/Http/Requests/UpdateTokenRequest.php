<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTokenRequest extends FormRequest
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
            'token' => 'required|string|unique:surveys|max:100',
        ];
    }

    public function messages()
    {
        return [
            'token.unique' => trans('lang.token_is_already_used'),
            'token.required' => trans('lang.token_is_required'),
            'token.max' => trans('lang.token_is_too_long', ['number' => 100]),
        ];
    }
}
