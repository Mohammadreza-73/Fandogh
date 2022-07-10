<?php

namespace App\Utilities;

class Lang
{
    public static function persianNumbers($input)
    {
        $fa_num = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $en_num = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($en_num, $fa_num, $input);
    }

    public static function latinNumbers($input)
    {
        $fa_num = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $en_num = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($fa_num, $en_num, $input);
    }
}
