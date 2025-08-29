<?php

namespace App\Http\Controllers;

use App\Models\SaldoKas;
use App\Models\ProdukDetail;
use App\Models\TransaksiKas;
use Illuminate\Http\Request;
use App\Models\HistoryTransaksi;
use App\Models\HistoryStokProduk;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function getDetailProduct(Request $request, $id)
    {
        $detailProduct = ProdukDetail::where('produk_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'detail_product' => $detailProduct,
        ]);
    }

    public function checkoutItem(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'items' => 'required|array',
                'items.*.productId' => 'required|exists:produk_detail,id',
                'items.*.productName' => 'required|string',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.unitId' => 'required|integer|min:1',
                'items.*.unitName' => 'required|string',
                'items.*.price' => 'required|numeric|min:0',
            ]);

            DB::beginTransaction();
            $saldoKas = SaldoKas::where('date', now()->format('Y-m-01'))->first();
            $totalPenjualan = 0;
            
            foreach ($validatedData['items'] as $item) {
                $produkDetail = ProdukDetail::where('id', $item['unitId'])->first();
                if ($produkDetail->kuantitas >= $item['quantity']) {
                    $produkDetail->update([
                        'kuantitas' => (integer)($produkDetail->kuantitas- $item['quantity']),
                    ]);
                    $produkDetail->save();
                    $totalPenjualan += $item['price'] * $item['quantity'];

                    HistoryStokProduk::create([
                        'produk_id' => $produkDetail->produk_id,
                        'produk_detail_id' => $produkDetail->id,
                        'qty_in' => 0,
                        'qty_out' => $item['quantity'],
                        'unit' => $item['unitName'],
                        'harga_unit' => $item['price'],
                        'sisa_stok' => $produkDetail->kuantitas - $item['quantity'],
                        'total_harga' => $item['price'] * $item['quantity'],
                        'keterangan' => 'Penjualan Produk',
                    ]);

                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Please re-check the qty availability.'
                    ], 422);
                }
            }
            
            $newTransaksiKas = [
                'saldo_kas_id' => $saldoKas->id,
                'jenis_transaksi' => 'pengeluaran',
                'keterangan' => 'Penjualan Produk',
                'cash_in' => $totalPenjualan,
                'cash_out' => 0,
                'current_saldo' => $saldoKas->cash + $totalPenjualan,
            ];

            TransaksiKas::create($newTransaksiKas);
            
            $historyLog = [
                'jenis_transaksi' => 'pendapatan',
                'keterangan' => 'Penjualan Produk',
                'cash_in' => $totalPenjualan,
                'cash_out' => 0,
                'hutang_in' => 0,
                'hutang_out' => 0,
            ];
            
            // saldoKas harus persis di atas nya historyTransaksi
            $saldoKas->update([
                'cash' => $saldoKas->cash + $totalPenjualan,
            ]);
            
            HistoryTransaksi::storeTransactionHistory($historyLog);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Items validated successfully',
                'data' => $validatedData,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function holdTransaction(Request $request)
    {
        $items = $request->items;

        return response()->json([
            'status' => 'success',
            'items' => $items,
        ]);
    }

    public function receiptTransaction(Request $request)
    {
        $items = $request->items;

        return response()->json([
            'status' => 'success',
            'items' => $items,
        ]);
    }

    public function shareTransaction(Request $request)
    {
        $items = $request->items;

        return response()->json([
            'status' => 'success',
            'items' => $items,
        ]);
    }
}
