<?php

namespace App\Http\Requests\Localisation;

use Illuminate\Foundation\Http\FormRequest;

class ContinentRequest extends FormRequest
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
            'libelle' => 'alpha_dash|required|max:50|min:2',
            'sigle' => 'alpha_dash|max:30|min:2',
            'visible' => 'boolean',
            'map' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB
            'flag' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB
        ];
    }
}
