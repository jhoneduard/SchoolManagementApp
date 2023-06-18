<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'id' => 'required',
            'names' => 'required|min:3|max:30',
            'surnames' => 'required|min:3|max:30',
            'phone' => 'required|numeric|digits:10',
        ];
    }

    public function messages()
    {
        return [
            // ID
            'id.required' => 'La identificacion  es requerida',

            // names
            'names.required' => 'El nombre es requerido',
            'names.min' => 'El nombre debe tener como minimo 3 caracteres',
            'names.max' => 'El nombre debe tener como maximo 50 caracteres',

            // surnames
            'surnames.required' => 'El apellido es requerido',
            'surnames.min' => 'El apellido debe tener como minimo 3 caracteres',
            'surnames.max' => 'El apellido debe tener como maximo 50 caracteres',

            // phone
            'phone.required' => 'El telefono es requerido',
            'phone.numeric' => 'El telefono debe tener unicamente numeros',
            'phone.digits' => 'El telefono debe tener maximo 10 digitos',
        ];
    }
}
