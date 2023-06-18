<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'id' => 'required|min:5|max:20|unique:users',
            'document_type' => 'required',
            'names' => 'required|min:3|max:30',
            'surnames' => 'required|min:3|max:30',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|numeric|digits:10',
            'id_category' =>  'required'
        ];
    }

    public function messages()
    {
        return [
            // ID
            'id.required' => 'La identificacion  es requerida',
            'id.min' => 'La identificacion debe tener como minimo 5 digitos',
            'id.max' => 'La identificacion debe tener como maximo 20 digitos',
            'id.unique' => 'Ya existe un usuario con esa identificacion',
            // document_type
            'document_type.required' => 'El tipo de documento es requerido',
            // names
            'names.required' => 'El nombre es requerido',
            'names.min' => 'El nombre debe tener como minimo 3 caracteres',
            'names.max' => 'El nombre debe tener como maximo 30 caracteres',

            // surnames
            'surnames.required' => 'El apellido es requerido',
            'surnames.min' => 'El apellido debe tener como minimo 3 caracteres',
            'surnames.max' => 'El apellido debe tener como maximo 30 caracteres',

            // email
            'email.required' => 'El correo electronico  es requerido',
            'email.email' => 'Ingrese un correo valido',
            'email.max' => 'El correo debe tener maximo 255 caracteres',
            'email.unique' => 'Ya existe un usuario con ese correo electronico',

            // phone
            'phone.required' => 'El telefono es requerido',
            'phone.numeric' => 'El telefono debe tener unicamente numeros',
            'phone.digits' => 'El telefono debe tener maximo 10 digitos',

            // id_category
            'id_category.required' => 'La categoria  es requerida'
        ];
    }
}
