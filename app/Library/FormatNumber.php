<?php
namespace App\Library;

use NumberFormatter;

class FormatNumber{
    public static function setNumberFormat($number){
        $format = NumberFormatter::create(app()->getLocale(), NumberFormatter::DECIMAL);
        return $format->format($number);
    }
}
