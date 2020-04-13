<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class dellCate extends FormRequest
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
            'name' => 'unique:category'
        ];
    }
    public function messages(){
        return [
            'name.unique' => 'xóa thành công'
        ];
    }
}
