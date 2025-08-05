<?php

namespace App\View\Components\Transaction;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TabNav extends Component
{
    public function __construct()
    {

    }
    public function render(): View|Closure|string
    {
        return view('components.transaction.tab-nav');
    }
}
