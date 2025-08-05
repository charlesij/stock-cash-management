<?php

namespace App\View\Components\SidebarItem;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Single extends Component
{
    public $route;
    public $title;
    public $icon;

    public function __construct($route, $title, $icon)
    {
        $this->route = $route;
        $this->title = $title;
        $this->icon = $icon;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.sidebar-item.single');
    }
}
