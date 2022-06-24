<?php

namespace App\Http\Requests\Federation;

use Illuminate\Foundation\Http\FormRequest;

class FederationRequest extends FormRequest
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
            'sport_id' => 'exists:App\Models\Federation\Sport,id',
            'email' => 'required|email|unique:federations',
            'adresse' => 'required|max:255',
            'telephone' => 'required|max:20',
        ];
    }
}
