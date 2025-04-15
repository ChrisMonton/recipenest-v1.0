<?php

namespace App\Helpers;

class FlasherHelper
{
    private static function defaultAlert()
    {
        // Source: https://php-flasher.io/
        // Source: https://php-flasher.io/library/notyf/
        return
        notyf()
        ->position('x', 'right')
        ->position('y', 'top')
        ->duration(15000)
        ->ripple(true)
        ->dismissible(true);
        // ->addSuccess('Warning! This is a warning')
    }

    public static function alert(string $type, string $message)
    {
        $types = ['success', 'error', 'info', 'warning'];

        if (in_array($type, $types)) {
            self::defaultAlert()->$type($message);
        } else {
            self::defaultAlert()->info($message);
        }
    }

}
