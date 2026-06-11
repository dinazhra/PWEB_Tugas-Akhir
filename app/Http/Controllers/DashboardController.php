<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Pupuk;

class DashboardController extends Controller
{
    public function index()
    {
        // ── STATISTIK KUNJUNGAN (tetap pakai session) ────────────────
        $visits = session('visit_count', 0);
        $visits++;
        session(['visit_count' => $visits]);

        if (!session()->has('first_visit_time')) {
            session(['first_visit_time' => Carbon::now()->translatedFormat('d F Y, H:i:s')]);
        }

        session(['last_visit_time' => Carbon::now()->translatedFormat('d F Y, H:i:s')]);

        $firstVisit = session('first_visit_time');
        $lastVisit  = session('last_visit_time');

        // ── STATS CARDS (data real) ──────────────────────────────────
        $totalProduk     = Pupuk::count();
        $totalInventaris = Pupuk::selectRaw('SUM(stok * harga) as total')->value('total') ?? 0;
        $stokMenipis     = Pupuk::menipis()->count();

        $statsData = [
            [
                'label' => 'Total Produk',
                'nilai' => $totalProduk,
                'warna' => '',
            ],
            [
                'label' => 'Total Nilai Inventaris',
                'nilai' => 'Rp ' . number_format($totalInventaris, 0, ',', '.'),
                'warna' => '',
            ],
            [
                'label' => 'Stok Menipis (<10)',
                'nilai' => $stokMenipis,
                'warna' => $stokMenipis > 0 ? 'warn' : '',
            ],
        ];

        // ── DATA PUPUK (data real) ───────────────────────────────────
        $dataPupuk = Pupuk::orderBy('tanggal_masuk', 'desc')
            ->get()
            ->map(fn($p) => [
                'kode'     => $p->kode,
                'nama'     => $p->nama,
                'kategori' => $p->kategori ?? '-',
                'stok'     => $p->stok,
                'harga'    => 'Rp ' . number_format($p->harga, 0, ',', '.'),
                'tanggal'  => $p->tanggal_masuk
                                ? Carbon::parse($p->tanggal_masuk)->format('Y-m-d')
                                : '-',
            ]);

        return view('dashboard', compact(
            'statsData',
            'dataPupuk',
            'visits',
            'firstVisit',
            'lastVisit'
        ));
    }

    public function resetCounter()
    {
        session()->forget(['visit_count', 'first_visit_time', 'last_visit_time']);

        return redirect()->back()->with('success_reset', 'Statistik kunjungan berhasil di-reset!');
    }
}