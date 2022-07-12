<?php

namespace App\Http\Requests\Federation;

use Illuminate\Foundation\Http\FormRequest;

class LigueRegionalRequest extends FormRequest
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
            'libelle' => 'required|max:255',
            'sigle' => 'required|max:20',
            //'federation_id' => 'exists:App\Models\Federation\Federation,id',
            'rattachement' => 'exists:regions,id',
            'email' => 'required|email|unique:ligue_regionales',
            'adresse' => 'required|max:255',
            'telephone' => 'required|max:20',
        ];
    }
}
