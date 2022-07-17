<?php

namespace App\Http\Requests\Alumno;

use App\Models\Alumno;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubirDocumentoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre' => ['required'],
            'tipo' => [
                'required',
                Rule::in(Alumno::TIPO),
            ],
            'documento' => ['required'],
        ];
    }
}
