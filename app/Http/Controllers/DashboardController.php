<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use App\Models\Simpanan;

class DashboardController extends Controller
{
    public function index()
    {
        $anggotaAktif = Anggota::where('status', 'aktif')->count();
        $totalAnggota = Anggota::count();
        $totalSimpanan = Simpanan::sum('jumlah');
        $totalPinjaman = Pinjaman::sum('jumlah_pokok');
        $totalAngsuran = Angsuran::where('status', 'dibayar')->sum('jumlah_bayar');

        $outstanding = Pinjaman::withSum('angsuran as pokok_terbayar', 'pokok')
            ->get()
            ->sum(function (Pinjaman $pinjaman) {
                return max(0, (float) $pinjaman->jumlah_pokok - (float) ($pinjaman->pokok_terbayar ?? 0));
            });

        return view('dashboard', [
            'anggotaAktif' => $anggotaAktif,
            'totalAnggota' => $totalAnggota,
            'totalSimpanan' => $totalSimpanan,
            'totalPinjaman' => $totalPinjaman,
            'outstanding' => $outstanding,
            'totalAngsuran' => $totalAngsuran,
            'recentAnggota' => Anggota::latest()->take(5)->get(),
            'recentSimpanan' => Simpanan::with('anggota')->latest()->take(5)->get(),
            'recentPinjaman' => Pinjaman::with('anggota')->withSum('angsuran as pokok_terbayar', 'pokok')->latest()->take(5)->get(),
            'recentAngsuran' => Angsuran::with('pinjaman.anggota')->latest()->take(5)->get(),
            'anggotaOptions' => Anggota::orderBy('nama')->get(),
            'pinjamanOptions' => Pinjaman::with('anggota')->orderByDesc('tanggal_cair')->get(),
        ]);
    }
}
