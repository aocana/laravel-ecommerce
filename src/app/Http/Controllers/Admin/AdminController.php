<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.index');
    }
}
