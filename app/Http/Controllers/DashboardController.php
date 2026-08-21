<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        protected LaporanPenjualanService $laporanService,
        protected MonitoringStokService $stokService
    ) {}

    public function index()
    {
        $user = Auth::user();

        // Ambil ringkasan data untuk ditampilkan di Beranda
        $ringkasan = $this->laporanService->ringkasanHariIni();

        return view('dashboard', [
            'tanggalHariIni'   => Carbon::now(),
            'ringkasan'        => $ringkasan,
            'produkTerlaris'   => $this->laporanService->produkTerlarisHariIni(),
            'produkStokRendah' => $this->stokService->produkStokRendah(),
            'produkStokHabis'  => $this->stokService->produkStokHabis(),
        ]);
    }
}