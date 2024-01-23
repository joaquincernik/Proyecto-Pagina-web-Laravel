<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;
class SocialServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return[
            'gender'=>'required',
            'time'=>'prohibited_if:button,1|required_if:button,0',

        ];

    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'gender.required'=>'Debes ingresar el genero',
            'time.prohibited_if'=>'Si ingresas el horario debes desactivar el boton de "Horario a confirmar"',
            'time.required_if'=>'Debes activar el boton de "Horario en confirmar" si no ingresas el horario estipulado',
                ];
    }
}
