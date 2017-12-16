<?php

namespace Application\Components;

class FunctionsLibrary
{
    public static function redirectTo($location = false)
    {
        if ($location) {
            header("Location: {$location}");
            exit;
        }
    }

    public static function clearString($str)
    {
        return trim(htmlentities($str));
    }

    public static function clearInt($int)
    {
        return abs((int)$int);
    }
}
