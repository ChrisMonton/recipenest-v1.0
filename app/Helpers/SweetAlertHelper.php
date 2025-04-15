<?php

namespace App\Helpers;

class SweetAlertHelper
{
    public static function alert(string $type, string $message)
    {
        $types = ['success', 'error', 'info', 'warning'];

        if (in_array($type, $types)) {
            sweetalert()->$type($message);
        } else {
            sweetalert()->info($message);
        }
    }


}
