<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AngsuranController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $sortOptions = [
            'tanggal_bayar' => 'Tanggal Bayar',
            'tanggal_jatuh_tempo' => 'Tanggal Jatuh Tempo',
            'jumlah_bayar' => 'Jumlah Bayar',
            'nomor_angsuran' => 'Nomor Angsuran',
            'status' => 'Status',
            'pinjaman' => 'Nomor Pinjaman',
            'created_at' => 'Terbaru',
        ];
        $sortColumns = [
            'tanggal_bayar' => 'angsurans.tanggal_bayar',
            'tanggal_jatuh_tempo' => 'angsurans.tanggal_jatuh_tempo',
            'jumlah_bayar' => 'angsurans.jumlah_bayar',
            'nomor_angsuran' => 'angsurans.nomor_angsuran',
            'status' => 'angsurans.status',
            'created_at' => 'angsurans.created_at',
        ];
        $requestedSort = (string) $request->query('sort', 'tanggal_bayar');
        $sort = array_key_exists($requestedSort, $sortOptions) ? $requestedSort : 'tanggal_bayar';
        $direction = (string) $request->query('direction') === 'asc' ? 'asc' : 'desc';

        $query = Angsuran::with('pinjaman.anggota')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nomor_angsuran', 'like', "%{$search}%")
                        ->orWhere('jumlah_bayar', 'like', "%{$search}%")
                        ->orWhere('pokok', 'like', "%{$search}%")
                        ->orWhere('bunga', 'like', "%{$search}%")
                        ->orWhere('denda', 'like', "%{$search}%")
                        ->orWhere('tanggal_jatuh_tempo', 'like', "%{$search}%")
                        ->orWhere('tanggal_bayar', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('keterangan', 'like', "%{$search}%")
                        ->orWhereHas('pinjaman', function ($query) use ($search) {
                            $query->where('nomor_pinjaman', 'like', "%{$search}%")
                                ->orWhereHas('anggota', function ($query) use ($search) {
                                    $query->where('nama', 'like', "%{$search}%")
                                        ->orWhere('nomor_anggota', 'like', "%{$search}%");
                                });
                        });
                });
            });

        if ($sort === 'pinjaman') {
            $query->orderBy(
                Pinjaman::select('nomor_pinjaman')
                    ->whereColumn('pinjamans.id', 'angsurans.pinjaman_id')
                    ->limit(1),
                $direction
            );
        } else {
            $query->orderBy($sortColumns[$sort], $direction);
        }

        return view('angsuran.index', [
            'angsurans' => $query->orderByDesc('angsurans.id')->paginate(10)->withQueryString(),
            'pinjamanOptions' => Pinjaman::with('anggota')->orderByDesc('tanggal_cair')->get(),
            'filters' => [
                'search' => $search,
                'sort' => $sort,
                'direction' => $direction,
            ],
            'sortOptions' => $sortOptions,
        ]);
    }

    public function create(): View
    {
        return view('angsuran.create', [
            'angsuran' => new Angsuran([
                'nomor_angsuran' => 1,
                'tanggal_jatuh_tempo' => now()->toDateString(),
                'status' => 'jatuh_tempo',
            ]),
            'pinjamans' => Pinjaman::with('anggota')->orderByDesc('tanggal_cair')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pinjaman_id' => ['required', 'exists:pinjamans,id'],
            'nomor_angsuran' => ['required', 'integer', 'min:1'],
            'jumlah_bayar' => ['required', 'numeric', 'min:0'],
            'pokok' => ['required', 'numeric', 'min:0'],
            'bunga' => ['required', 'numeric', 'min:0'],
            'denda' => ['required', 'numeric', 'min:0'],
            'tanggal_jatuh_tempo' => ['required', 'date'],
            'tanggal_bayar' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['jatuh_tempo', 'dibayar', 'tertunda'])],
            'keterangan' => ['nullable', 'string'],
        ]);

        Angsuran::create($data);

        if ($request->filled('_modal')) {
            return back()->with('success', 'Angsuran berhasil ditambahkan.');
        }

        return redirect()->route('angsuran.index')->with('success', 'Angsuran berhasil ditambahkan.');
    }

    public function show(Angsuran $angsuran): View
    {
        $angsuran->load('pinjaman.anggota');

        return view('angsuran.show', compact('angsuran'));
    }

    public function edit(Angsuran $angsuran): View
    {
        return view('angsuran.edit', [
            'angsuran' => $angsuran,
            'pinjamans' => Pinjaman::with('anggota')->orderByDesc('tanggal_cair')->get(),
        ]);
    }

    public function update(Request $request, Angsuran $angsuran)
    {
        $data = $request->validate([
            'pinjaman_id' => ['required', 'exists:pinjamans,id'],
            'nomor_angsuran' => ['required', 'integer', 'min:1'],
            'jumlah_bayar' => ['required', 'numeric', 'min:0'],
            'pokok' => ['required', 'numeric', 'min:0'],
            'bunga' => ['required', 'numeric', 'min:0'],
            'denda' => ['required', 'numeric', 'min:0'],
            'tanggal_jatuh_tempo' => ['required', 'date'],
            'tanggal_bayar' => ['nullable', 'date'],
            'status' => ['required', Rule::in(['jatuh_tempo', 'dibayar', 'tertunda'])],
            'keterangan' => ['nullable', 'string'],
        ]);

        $angsuran->update($data);

        if ($request->filled('_modal')) {
            return back()->with('success', 'Angsuran berhasil diperbarui.');
        }

        return redirect()->route('angsuran.index')->with('success', 'Angsuran berhasil diperbarui.');
    }

    public function destroy(Angsuran $angsuran)
    {
        $angsuran->delete();

        return redirect()->route('angsuran.index')->with('success', 'Angsuran berhasil dihapus.');
    }
}
