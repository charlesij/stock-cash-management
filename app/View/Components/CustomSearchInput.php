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
    public $showLabel;
    public $label;
    public ?string $formActionName;
    public ?string $formActionMethod;

    public function __construct($id, $name, $placeholder, $addButton, $showLabel = 'true', $label = null, ?string $formActionName = null, ?string $formActionMethod = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->addButton = $addButton == 'false' ? false : true;
        $this->showLabel = $showLabel === 'false' ? false : true; 
        $this->label = $label;
        $this->formActionName = $formActionName;
        $this->formActionMethod = $formActionMethod;
    }

    public function render(): View|Closure|string
    {
        return view('components.custom-search-input');
    }
}
