<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,id,' . auth()->user()->id,
            'image' => 'sometimes|nullable|image',
        ];

        return $rules;

    }//end of rules

}//end of request
