<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.app', [
            'categories' => Category::latest()->get()
        ]);
    }
}
