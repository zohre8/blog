<?php

if (!function_exists('convertPersianNumbersToEnglish')) {
    function convertPersianNumbersToEnglish(string $string): string
    {
        $persian = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        $english = ['0','1','2','3','4','5','6','7','8','9'];
        return str_replace($persian, $english, $string);
    }
}
if (!function_exists('make_slug')) {
    function make_slug($string)
    {
        return preg_replace('/\s+/u','-',trim($string));
    }
}
