<?php

if ( ! function_exists('asMoney')) {
    function asMoney($value)
    {
        $value = (double) $value;

        return (double) bcdiv(number_format($value, 5), 1, 2);
    }
}

if ( ! function_exists('showMoney')) {
    function showMoney($value, $format = null, $showSymbols = true)
    {
        $value = (double) $value;
        if ($format === null) {
            $format = config('settings.global.money_format', '%i');
        }

        // return \money_format( $format, $this->value)
        if ( ! function_exists('money_format')) {
            $negative = false;
            if ($value < 0) {
                $negative = true;
                $value = abs($value);
            }

            return ($negative ? '-' : '').
                   ($showSymbols ? config('settings.global.pre_currency_symbol') : '').
                   number_format(asMoney($value), 2, '.', $showSymbols ? ',' : '').
                   ($showSymbols ? config('settings.global.post_currency_symbol') : '');
        } else {
            // As of this moment, this is not available on windows. The languages are also not available when I used a custom function from http://www.php.net/manual/en/function.money-format.php
            setlocale(LC_MONETARY, config('settings.global.money_locale', 'en_CA.utf8'));

            return money_format($format, $value);
        }
    }
}

if ( ! function_exists('gen_uuid')) {
    function gen_uuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}

if ( ! function_exists('dot_explode')) {
    function dot_explode($array)
    {
        $newArray = [];
        foreach ($array as $key => $value) {
            $exploded = explode('.', $key);

            $subArray = [];
            $refArray = &$subArray;
            foreach ($exploded as $subkey) {
                $refArray = &$refArray[$subkey];
            }
            $refArray = $value;

            $newArray = array_merge_recursive($subArray, $newArray);

            unset($subArray);
        }

        return $newArray;
    }
}
