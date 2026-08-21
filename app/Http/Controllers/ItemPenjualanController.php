<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class ItemPenjualanController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validasi input dari Blade
        $request->validate([
            'penjualan_id' => 'required',
            'produk_id'    => 'required',
            'kuantitas'    => 'required|integer|min:1'
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 1. Cari transaksi penjualan yang masih OPEN
                $sale = Penjualan::where('id', $request->penjualan_id)
                    ->where('status', 'OPEN')
                    ->firstOrFail();

                // 2. Lock data produk untuk menghindari race condition stok
                $product = Produk::lockForUpdate()->findOrFail($request->produk_id);

                $qty = (int) $request->kuantitas;

                // 3. Cek ketersediaan stok produk
                if ($product->stok < $qty) {
                    throw new Exception('Stok produk tidak mencukupi.');
                }

                // 4. Deteksi harga produk (Mendukung nama kolom 'harga' maupun 'harga_jual')
                $hargaSatuan = $product->harga ?? $product->harga_jual ?? 0;

                if ($hargaSatuan <= 0) {
                    throw new Exception('Harga produk belum diatur atau bernilai 0 pada Master Produk.');
                }

                // 5. Kurangi stok produk
                $product->decrement('stok', $qty);

                // 6. Cek apakah item sudah ada di keranjang transaksi ini
                $item = ItemPenjualan::where('penjualan_id', $sale->id)
                    ->where('produk_id', $product->id)
                    ->lockForUpdate()
                    ->first();

                if ($item) {
                    // Jika sudah ada: Tambah kuantitas
                    $item->kuantitas += $qty;
                } else {
                    // Jika belum ada: Buat data item baru
                    $item = new ItemPenjualan([
                        'penjualan_id' => $sale->id,
                        'produk_id'    => $product->id,
                        'kuantitas'    => $qty,
                        'harga_satuan' => $hargaSatuan,
                    ]);
                }

                // Hitung subtotal dan simpan item
                $item->subtotal = $item->kuantitas * $hargaSatuan;
                $item->save();

                // 7. Update total pembayaran pada tabel Penjualan
                $totalBaru = ItemPenjualan::where('penjualan_id', $sale->id)->sum('subtotal') ?? 0;
                $sale->update([
                    'total_pembayaran' => $totalBaru
                ]);
            });
        } catch (Exception $e) {
            // Menggunakan key 'error' (singular) agar tidak mengganggu $errors di Blade
            return redirect()->back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Item berhasil ditambahkan ke keranjang');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, ItemPenjualan $itempenjualan)
    {
        $request->validate([
            'kuantitas' => 'required|integer|min:1'
        ]);

        try {
            DB::transaction(function () use ($request, $itempenjualan) {
                $produk = Produk::where('id', $itempenjualan->produk_id)->lockForUpdate()->first();

                $newQty = (int) $request->kuantitas;
                $selisih = $newQty - $itempenjualan->kuantitas;

                // Jika qty bertambah → kurangi stok
                if ($selisih > 0) {
                    if (!$produk || $produk->stok < $selisih) {
                        throw new Exception('Stok produk tidak mencukupi');
                    }
                    $produk->decrement('stok', $selisih);
                }

                // Jika qty berkurang → kembalikan stok
                if ($selisih < 0) {
                    if ($produk) {
                        $produk->increment('stok', abs($selisih));
                    }
                }

                // Tentukan harga satuan yang valid
                $hargaSatuan = $itempenjualan->harga_satuan ?? $produk->harga ?? $produk->harga_jual ?? 0;

                // Update item
                $itempenjualan->update([
                    'kuantitas'    => $newQty,
                    'harga_satuan' => $hargaSatuan,
                    'subtotal'     => $newQty * $hargaSatuan
                ]);

                // Update total pembayaran pada penjualan
                $penjualanId = $itempenjualan->penjualan_id;
                $totalBaru = ItemPenjualan::where('penjualan_id', $penjualanId)->sum('subtotal') ?? 0;

                Penjualan::where('id', $penjualanId)->update([
                    'total_pembayaran' => $totalBaru
                ]);
            });
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Jumlah item berhasil diperbarui');
    }

    public function destroy(ItemPenjualan $itempenjualan)
    {
        try {
            DB::transaction(function () use ($itempenjualan) {
                $produk      = $itempenjualan->produk;
                $penjualanId = $itempenjualan->penjualan_id;

                // Kembalikan stok produk
                if ($produk) {
                    $produk->increment('stok', $itempenjualan->kuantitas);
                }

                // Hapus item dari keranjang
                $itempenjualan->delete();

                // Update total pembayaran pada transaksi penjualan
                $totalBaru = ItemPenjualan::where('penjualan_id', $penjualanId)->sum('subtotal') ?? 0;
                Penjualan::where('id', $penjualanId)->update([
                    'total_pembayaran' => $totalBaru
                ]);
            });
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Item berhasil dihapus dari keranjang');
    }
}