<?php

namespace App\Traits\Traits;
use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    public function upload($imageFile, $directory)
    {
        $imgExt = $imageFile->getClientOriginalExtension();
        $fileName = time() . '.' . $imgExt;

        // Store the image in the specified directory under 'public'
        $path = $imageFile->storeAs($directory, $fileName, 'public');
        return $path;
    }

    public function deleteFile($path)
    {
        // Ensure the path is correctly prefixed with 'public/'
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}