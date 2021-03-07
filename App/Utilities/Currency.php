<?php

namespace App\Utilities;

class Currency
{
    public static function formatPriceInHezarToman(int $amount): int
    {
        return $amount / 1000;
    }

    public static function formatPriceInMillionToman(int $amount): int
    {
        return $amount / 1000000;
    }

    public static function formatPriceInRial(int $amount): int
    {
        return $amount * 10;
    }
}