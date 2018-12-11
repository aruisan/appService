<?php

namespace App\Http\Requests\Movil;

use Illuminate\Foundation\Http\FormRequest;

class movilApiRequest extends FormRequest
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
            'email' => 'required',
            'name' => 'required',
            'avatar' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'el correo es necesario para la api.',
            'name.required' => 'el nombre es necesario para la api.',
            'avatar.required' => 'el avatar es necesario para la api.',
        ];
    
    }
}
