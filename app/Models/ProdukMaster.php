<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ProdukMaster extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'satuan_id',
        'nama',
        'harga_beli',
    ];

    protected $table = 'produk_master';
    
    public function searchableAs():string
    {
        return 'nama';
    }
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }

    public function produkDetail()
    {
        return $this->hasMany(ProdukDetail::class, 'produk_id', 'id');
    }

    public static function returnGlobalStockAvailability(): int
    {
        $products = Produk::with('produkDetail')->get();

        $availableProductCount = 0;

        foreach ($products as $product) {
            $maxQuantity = $product->produkDetail
                ->map(function ($detail) {
                    $raw = $detail->kuantitas;

                    if ($raw === null) {
                        return 0;
                    }

                    $numeric = is_numeric($raw) ? (float) $raw : 0;
                    if ($numeric < 0) {
                        $numeric = 0;
                    }

                    return $numeric;
                })
                ->max() ?? 0;

            if ($maxQuantity > 0) {
                $availableProductCount++;
            }
        }

        return $availableProductCount;
    }
}
