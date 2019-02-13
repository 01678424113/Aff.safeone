<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IsJson implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return is_string($value) && is_array(json_decode($value, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute không đúng định dạng json.';
    }
}
