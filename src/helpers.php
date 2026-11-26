<?php

if ( ! function_exists('asMoney')) {
    function asMoney($value)
    {
        $value = (float) $value;

        return (float) number_format($value, 2, '.', '');
    }
}

if ( ! function_exists('showMoney')) {
    function showMoney($value, $format = null, $showSymbols = true)
    {
        // $format is kept for backwards compatibility only. It was used by money_format(),
        // which was removed in PHP 8.0, so it no longer has any effect.
        $value = (float) $value;

        $negative = false;
        if ($value < 0) {
            $negative = true;
            $value = abs($value);
        }

        return ($negative ? '-' : '').
               ($showSymbols ? config('settings.global.pre_currency_symbol') : '').
               number_format($value, 2, '.', $showSymbols ? ',' : '').
               ($showSymbols ? config('settings.global.post_currency_symbol') : '');
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
