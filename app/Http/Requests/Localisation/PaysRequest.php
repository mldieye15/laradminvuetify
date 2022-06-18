<?php

namespace App\Http\Requests\Localisation;

use Illuminate\Foundation\Http\FormRequest;

class PaysRequest extends FormRequest
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
            'libelle' => 'required|max:80|min:2',
            'sigle' => 'nullable|max:40',
            'indicatif' => 'nullable|max:10',
            'code_alpha2' => 'nullable|size:2',
            'code_alpha3' => 'nullable|size:3',
            'continent_id' => 'exists:App\Models\Localisation\Continent,id'
            //'visible' => 'boolean',
            //'map' => 'mimes:jpg,jpeg,png,svg|max:5120', // 5MB
            //'flag' => 'mimes:jpg,jpeg,png,svg|max:5120', // 5MB
        ];
    }
}
