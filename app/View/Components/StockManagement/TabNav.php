<?php

namespace App\View\Components\StockManagement;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TabNav extends Component
{
    public function __construct()
    {
        //
    }

    public function render(): View|Closure|string
    {
        return view('components.stock-management.tab-nav');
    }
}
