<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules = [
            'name' => 'required|unique:roles',
            'permissions' => 'required',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $role = $this->route()->parameter('role');

            $rules['name'] = 'required|unique:roles,id,' . $role->id;

        }//end of if

        return $rules;
    }
}
