<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;
class InfocoopRequest extends FormRequest
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
            'image'=>'prohibits:title,prohibits:content',
            'title'=>'required_with:content,prohibits:image',
            'content'=>'required_with:title',
            'datein'=>'required',
            'dateout'=>'required'
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
            'datein.required'=>'Tienes que agregar una fecha de entrada',
            'dateout.required'=>'Tienes que agregar una fecha de salida',
            'image.prohibits'=>'No puedes escribir un titulo o contenido si pones una imagen',
            'image.required_without_all:title,content'=>'Debes poner una imagen si no pones titulo ni contenido',
            'title.required_with'=>'Si ingresar un titulo, debes ingresar el contenido',
            'required_without'=>'No puedes agregar una imagen si ingresas un titulo o contenido',
            'content.required_with'=>'Si ingresar un contenido, debes ingresar el titulo',
            
        ];
    }
}
