<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSubjectRequest extends FormRequest
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
            'id_teacher' => 'required',
            'id_category_subject' => 'required',
            'initial_date' => 'required',
            'end_date' => 'required'
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
            'description.required' => 'La descriocion es requerida',
            'description.min' => 'La descripcion debe tener como minimo 3 caracteres',
            'description.max' => 'La descripcion debe tener como maximo 100 caracteres',
            'id_teacher.required' => 'El docente es requerido',
            'id_category_subject.required' => 'La categoria es requerida para el registro',
            'initial_date.required' => 'La fecha de incio es obligatoria',
            'end_date.required' => 'La fecha de finalizacion del curso es obligatoria'
        ];
    }
}
