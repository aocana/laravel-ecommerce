<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Category;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __call($name, $arguments)
    {
        [$class, $action, $folder] = $arguments;
        $image = request()->hasFile('image')
            ? $this->fileService->upload($folder, request()->image)
            : null;

        $model = $class::$action([
            'name' => request()->name,
            'slug' => request()->slug,
            'image' => $image,
        ]);
    }
}
