<?php

namespace App\Http\Requests\Localisation;

use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
            'sigle' => 'required|max:40',
            'codification' => 'nullable|max:10',
            'indicatif' => 'nullable|max:10',
            'visible' => 'boolean',
            'pays_id' => 'exists:App\Models\Localisation\Pays,id'
        ];
    }
}
