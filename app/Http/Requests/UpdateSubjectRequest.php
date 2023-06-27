<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
            'name' => 'required|min:3|max:90',
            'description' => 'required|min:3|max:100',
            'initDate' => 'required',
            'endDate' => 'required'
        ];
    }

    public function messages()
    {
        return [
            // name
            'name.required' => 'El nombre es requerido',
            'name.min' => 'El nombre debe tener como minimo 3 caracteres',
            'name.max' => 'El nombre debe tener como maximo 90 caracteres',
            // description
            'description.required' => 'El apellido es requerido',
            'description.min' => 'El apellido debe tener como minimo 3 caracteres',
            'description.max' => 'El apellido debe tener como maximo 100 caracteres',

            // init date
            'initDate.required' => 'La fecha inicial es requerida',
            // end date
            'endDate.required' => 'La fecha final es requerida'
        ];
    }
}
