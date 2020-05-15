<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addClientRequest extends FormRequest
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
            'email' => 'unique:clients'
        ];
    }

    public function messages(){
        return [
            'email.unique' => 'Địa chỉ email đã tồn tại',
        ];
    }
}
