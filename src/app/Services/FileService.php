<?php

namespace App\Services;

class FileService
{
    public function upload(string $folder, $file): ?string
    {
        $filePath = null;

        if ($file) {
            $filePath = $file->store($folder);
        }

        return $filePath;
    }
}
