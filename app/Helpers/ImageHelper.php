<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class ImageHelper
{
    /**
     * Handle upload an image.
     * Names file including a time stamp
     */
    public static function uploadImage(UploadedFile $file)
    {
        //Get the filename
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        //Get the extension
        $extension = $file->getClientOriginalExtension();
        //Create new filename
        $storedFilename = $filename . '_' . time() . '.' . $extension;

        //Upload the image
        $path = $file->storeAs('public/images', $storedFilename);

        return $storedFilename;
    }
}
