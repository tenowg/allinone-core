<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePermissionsGroup extends FormRequest
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
            'id' => 'required|integer',
            'granted' => 'array|nullable',
            'filters.corporations' => 'array|nullable',
            'filters.alliances' => 'array|nullable',
            'filters.characters' => 'array|nullable',
            'inverse.corporations' => 'array|nullable',
            'inverse.alliances' => 'array|nullable',
            'inverse.characters' => 'array|nullable'
        ];
    }
}
