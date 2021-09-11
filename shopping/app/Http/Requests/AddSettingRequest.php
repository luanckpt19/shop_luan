<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSettingRequest extends FormRequest
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
            'config_key' => 'bail|required|unique:settings|max:255|min:10',
            'config_value'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'config_key.required' => 'config key không được phép để trống',
            'config_key.unique' => 'config key không được trùng',
            'config_key.max' => 'config key không quá 255 ký tự',
            'config_key.min' => 'config key không quá quá ngắn, phải trên 10 ký tự',
            'config_value.required' => 'config value không được để trống',


        ];
    }
}
