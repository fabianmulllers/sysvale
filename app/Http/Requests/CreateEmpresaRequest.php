<?php

namespace sysvale\Http\Requests;

use sysvale\Http\Requests\Request;

class CreateEmpresaRequest extends Request
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
            //
            'name_empresa'=>'required ',
            'rut_empresa' =>'required|unique:empresas',
            'direccion'=>'required',
            'name_departamento' =>''
        ];
    }
}
