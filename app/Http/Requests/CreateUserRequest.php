<?php

namespace sysvale\Http\Requests;

use sysvale\Http\Requests\Request;

class CreateUserRequest extends Request
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
            'name'=>'required ',
            'last_name' =>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required',
            'type'=>'required|in:user,admin,approver',
            'empresas'=>'',
            'departamentos'=>''
        ];
    }
}
