<?php

namespace sysvale\Http\Requests;

use Illuminate\Routing\Route;
use sysvale\Http\Requests\Request;

class EditEmpresaRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    private $route;

    public function __construct(Route $route)
    {

       $this->route=$route;
    }

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
            'name_empresa'=>'required',
            'rut_empresa'=>'required|unique:empresas,rut_empresa,'.$this->route->getParameter('empresas'),
            'direccion' => 'required'
        ];

    }
}
