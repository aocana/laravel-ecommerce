<?php

namespace App\Services;

class FileService
{
    //store image to path
    public function upload(string $folder, $file): ?string
    {
        $filePath = null;

        if ($file) {
            $filePath = $file->store($folder);
        }

        return $filePath;
    }
}
