<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class Nav extends Component
{

    public $items;

    public $active;
    public function __construct()
    {
         $this->items = config('Nav'); 
         $this->active = Route::currentRouteName();   
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav');
    }
}
