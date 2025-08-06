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
    public $addButton;
    public $options;
    public $formActionName;
    public $formActionMethod;

    public function __construct($id, $name, $placeholder, $addButton, $options, $formActionName, $formActionMethod)
    {
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->addButton = $addButton;
        $this->options = $options;
        $this->formActionName = $formActionName;
        $this->formActionMethod = $formActionMethod;
    }

    public function render(): View|Closure|string
    {
        return view('components.custom-search-input');
    }
}
