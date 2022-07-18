<?php

namespace App\Http\Requests\Params;

use Illuminate\Foundation\Http\FormRequest;

class GradePratiquantRequest extends FormRequest
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
            'libelle' => 'required|max:100',
            'sigle' => 'required|max:20',
            'age_min' => 'required|integer|min:2|max:100',
            'age_max' => 'required|integer|min:2|max:100',
            'niveau' => 'required|integer'
        ];
    }
}
