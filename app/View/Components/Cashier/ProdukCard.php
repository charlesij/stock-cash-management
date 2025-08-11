<?php

namespace App\View\Components\Cashier;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProdukCard extends Component
{
    public bool $isNew;
    public $produk;
    public $imageUrl;
    public $stock;
    public $namaProduk;
    public $hargaProduk;

    public function __construct(
        $produk, 
        $isNew = false, 
        $imageUrl = null, 
        $stock = null, 
        $namaProduk = null, 
        $hargaProduk = null)
    {
        $this->produk = $produk;
        $this->isNew = $isNew;
        $this->imageUrl = $imageUrl;
        $this->stock = $stock;
        $this->namaProduk = $namaProduk;
        $this->hargaProduk = $hargaProduk;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.cashier.produk-card');
    }
}
