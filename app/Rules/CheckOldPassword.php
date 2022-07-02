<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class CheckOldPassword implements Rule
{

    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
        return Hash::check($value, auth()->user()->password);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('users.incorrect_old_password');
    }
}
