<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomSearchInput extends Component
{
    public $id;
    public $name;
    public $placeholder;
    public $dataItems;

    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.custom-search-input');
    }
}
