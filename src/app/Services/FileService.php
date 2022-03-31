<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function upload(string $folder, $file): ?string
    {
        $filePath = null;
        if ($file) $filePath = $file->store($folder);

        return $filePath;
    }

    public function delete(string $file)
    {
        Storage::delete($file);
    }
}
