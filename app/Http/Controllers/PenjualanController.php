<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Menampilkan daftar riwayat transaksi penjualan
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            // Filter berdasarkan role kasir
            ->when($user->role && $user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            // Search nama user
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Menampilkan halaman Kasir / POS
     */
    public function create(SearchRequest $request)
    {
        // 1. Cari draft transaksi OPEN milik kasir, atau buat baru
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status'  => 'OPEN'
            ],
            [
                'total_pembayaran'  => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        // 2. Ambil item keranjang belanjaan transaksi ini
        $cartItems = $sale->itemPenjualan()->with('produk')->get();

        // 3. Pencarian katalog produk
        $keyword = $request->input('search');

        $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'cartItems', 'products', 'mode'));
    }

    /**
     * Menampilkan detail transaksi
     */
    public function show(Penjualan $penjualan)
    {
        $sale = $penjualan->load('itemPenjualan.produk');
        $cartItems = $sale->itemPenjualan;
        $products = Produk::orderBy('nama')->get();
        $mode = 'view';

        return view('penjualan.detail', compact('sale', 'cartItems', 'products', 'mode'));
    }

    /**
     * Menampilkan form edit transaksi
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if(in_array($sale->status, ['COMPLETED', 'CLOSED']), 403, 'Transaksi yang sudah selesai tidak dapat diubah.');

        $sale->load('itemPenjualan.produk');
        $cartItems = $sale->itemPenjualan;
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'cartItems', 'products', 'mode'));
    }

    /**
     * Memproses dan menyelesaikan transaksi (Selesai & Bayar)
     */
    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'payment_method'    => 'nullable|in:CASH,QRIS,TRANSFER',
            'metode_pembayaran' => 'nullable|in:CASH,QRIS,TRANSFER',
            'status'            => 'nullable|in:OPEN,CLOSED,COMPLETED',
        ]);

        if ($penjualan->status !== 'OPEN') {
            return back()->with('error', 'Transaksi sudah diproses.');
        }

        if ($penjualan->itemPenjualan()->count() === 0) {
            return back()->with('error', 'Keranjang belanja masih kosong.');
        }

        DB::transaction(function () use ($penjualan, $request) {
            // Hitung ulang total pembayaran (mencegah manipulasi client-side)
            $total = $penjualan->itemPenjualan()->sum('subtotal');

            // Tangkap metode pembayaran dari input Blade (fleksibel)
            $metode = $request->payment_method ?? $request->metode_pembayaran ?? $penjualan->metode_pembayaran ?? 'CASH';

            $penjualan->update([
                'metode_pembayaran' => $metode,
                'total_pembayaran'  => $total,
                'status'            => 'COMPLETED',
            ]);
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil diselesaikan!');
    }

    /**
     * Membatalkan / menghapus transaksi
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);

        if ($penjualan->status !== 'OPEN') {
            return redirect()
                ->route('penjualan.index')
                ->with('error', 'Transaksi yang sudah selesai tidak bisa dibatalkan.');
        }

        DB::transaction(function () use ($penjualan) {
            foreach ($penjualan->itemPenjualan as $item) {
                // Kembalikan stok produk
                if ($item->produk) {
                    $item->produk->increment('stok', $item->kuantitas);
                }
            }

            // Hapus relasi item & transaksi
            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan dan stok dikembalikan.');
    }
}