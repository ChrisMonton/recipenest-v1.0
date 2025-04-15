<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function imageUpload($file, string $disk = 'media')
    {
        // Use disk
        $disk = $disk == 'media' ? 'media' : 'profiles';
        // Hash name
        $name = $file->hashName();
        // Store in directory
        Storage::disk('media')->putFileAs('', $file, $name);
        // Return path
        return 'images/media/'.$name;
    }
}
