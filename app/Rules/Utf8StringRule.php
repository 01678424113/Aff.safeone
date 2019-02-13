<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Utf8StringRule implements Rule
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
        //return ( ! preg_match("/^[[:alpha:]- 1234567890_-ÀÁẢÃẠÂẦẤẨẪẬĂẰẮẲẴẶÄÅĀĄĂÆÇĆČĈĊĎĐÈÉẺẼẸÊỀẾỂỄỆËĒĘĚĔĖĜĞĠĢĤĦÌÍỈĨỊÎÏĪĨĬĮİĲĴĶŁĽĹĻĿÑŃŇŅŊÒÓỎÕỌÔỒỐỔỖỖƠỜỚỞỠỢÕÖØŌŐŎŒŔŘŖŚŠŞŜȘŤŢŦȚÙÚŨỤƯỪỨỬỮỰÛÜŪŮŰŬŨŲŴÝỲỶỸỴŶŸŹŽŻàáảãạâầấẩẫậăằắẳẵặãäåæçèéẻẽẹêềếểễệëìíỉĩịîïñòóỏõọôồốổỗộơờớởỡợõöøùúủũũưừứửữựûüýỳỷỹỵÿœšß_.,:?!;\r\n]+$/", $value)) ? false : true;
        return $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute không được chứa ký tự đặc biệt.';
    }
}
