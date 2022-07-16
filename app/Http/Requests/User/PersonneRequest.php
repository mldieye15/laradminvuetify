<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PersonneRequest extends FormRequest
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
            'prenoms' => 'required|min:2|max:60',
            'nom' => 'required|min:2|max:80',
            'sexe' => ['required', Rule::in(['HOMME', 'FEMME'])],
            'surnom' => 'max:15',
            'fonction' => 'max:60',
            'date_naiss' => 'date|required',
            'lieu_naiss' => 'required|min:2',
            //'cin' => '',
            'adresse' => 'required',
            'telephone' => 'required|max:20',
            'email' => 'email|unique:users',
            'type_piece_ident' => ['required', Rule::in(['CIN', 'PASSPORT', 'APPRENANT', 'PROFESSIONNEL'])],
            'pays_naiss' => 'required|exists:pays,id',
            'pays_natio' => 'required|exists:pays,id',
        ];
    }
}
