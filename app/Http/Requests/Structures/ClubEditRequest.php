<?php

namespace App\Http\Requests\Structures;

use Illuminate\Foundation\Http\FormRequest;

class ClubEditRequest extends FormRequest
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
            'ligue_regional' => 'required|exists:ligue_regionales,id',
            'email' => 'required|email',
            'adresse' => 'required|max:255',
            'telephone' => 'required|max:20',
        ];
    }
}
