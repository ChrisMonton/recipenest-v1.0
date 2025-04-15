<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Str;

class CustomHelper
{
    /**
     * Date to text, April 30th 2024
     *
     * @param [type] $dateString
     *
     * @return void
     */
    public static function dateToReadable($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)
            ->format('F jS Y');
    }


    /**
     * Date to text, Tuesday, April 30th 2024
     *
     * @param [type] $dateString
     *
     * @return void
     */
    public static function dateToReadableFull($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)
            ->format('l, F jS Y');
    }

    /**
     * Date to text, Tue, Apr 30th 2024
     *
     * @param [type] $dateString
     *
     * @return void
     */
    public static function dateToReadableFullAbbr($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)
        ->format('D, M jS Y');
    }

    /**
     * Date to text, Tue, Apr 30th 2024
     *
     * @param [type] $dateString
     *
     * @return void
     */
    public static function dateToReadableWithTime($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)
        ->format('F jS Y \a\t g:ia');
    }


    public static function toCapitalize($text)
    {
        return ucwords($text);
    }



}
