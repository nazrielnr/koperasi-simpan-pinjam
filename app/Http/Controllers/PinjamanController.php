<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PinjamanController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $sortOptions = [
            'tanggal_cair' => 'Tanggal Cair',
            'jatuh_tempo' => 'Jatuh Tempo',
            'jumlah_pokok' => 'Jumlah Pokok',
            'status' => 'Status',
            'nomor_pinjaman' => 'Nomor Pinjaman',
            'anggota' => 'Nama Anggota',
            'created_at' => 'Terbaru',
        ];
        $sortColumns = [
            'tanggal_cair' => 'pinjamans.tanggal_cair',
            'jatuh_tempo' => 'pinjamans.jatuh_tempo',
            'jumlah_pokok' => 'pinjamans.jumlah_pokok',
            'status' => 'pinjamans.status',
            'nomor_pinjaman' => 'pinjamans.nomor_pinjaman',
            'created_at' => 'pinjamans.created_at',
        ];
        $requestedSort = (string) $request->query('sort', 'tanggal_cair');
        $sort = array_key_exists($requestedSort, $sortOptions) ? $requestedSort : 'tanggal_cair';
        $direction = (string) $request->query('direction') === 'asc' ? 'asc' : 'desc';

        $query = Pinjaman::with('anggota')
            ->withSum('angsuran as pokok_terbayar', 'pokok')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nomor_pinjaman', 'like', "%{$search}%")
                        ->orWhere('jumlah_pokok', 'like', "%{$search}%")
                        ->orWhere('bunga_persen', 'like', "%{$search}%")
                        ->orWhere('tenor_bulan', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('keterangan', 'like', "%{$search}%")
                        ->orWhereHas('anggota', function ($query) use ($search) {
                            $query->where('nama', 'like', "%{$search}%")
                                ->orWhere('nomor_anggota', 'like', "%{$search}%");
                        });
                });
            });

        if ($sort === 'anggota') {
            $query->orderBy(
                Anggota::select('nama')
                    ->whereColumn('anggotas.id', 'pinjamans.anggota_id')
                    ->limit(1),
                $direction
            );
        } else {
            $query->orderBy($sortColumns[$sort], $direction);
        }

        return view('pinjaman.index', [
            'pinjamans' => $query->orderByDesc('pinjamans.id')->paginate(10)->withQueryString(),
            'anggotaOptions' => Anggota::orderBy('nama')->get(),
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
        return view('pinjaman.create', [
            'pinjaman' => new Pinjaman([
                'status' => 'pengajuan',
                'tanggal_cair' => now()->toDateString(),
                'jatuh_tempo' => now()->addMonths(12)->toDateString(),
                'bunga_persen' => 1.5,
                'tenor_bulan' => 12,
            ]),
            'anggotas' => Anggota::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'anggota_id' => ['required', 'exists:anggotas,id'],
            'nomor_pinjaman' => ['required', 'string', 'max:50', 'unique:pinjamans,nomor_pinjaman'],
            'jumlah_pokok' => ['required', 'numeric', 'min:0'],
            'bunga_persen' => ['required', 'numeric', 'min:0'],
            'tenor_bulan' => ['required', 'integer', 'min:1'],
            'tanggal_cair' => ['required', 'date'],
            'jatuh_tempo' => ['required', 'date', 'after_or_equal:tanggal_cair'],
            'status' => ['required', Rule::in(['pengajuan', 'berjalan', 'lunas', 'ditolak'])],
            'keterangan' => ['nullable', 'string'],
        ]);

        Pinjaman::create($data);

        if ($request->filled('_modal')) {
            return back()->with('success', 'Pinjaman berhasil ditambahkan.');
        }

        return redirect()->route('pinjaman.index')->with('success', 'Pinjaman berhasil ditambahkan.');
    }

    public function show(Pinjaman $pinjaman): View
    {
        $pinjaman->load(['anggota', 'angsuran']);

        return view('pinjaman.show', compact('pinjaman'));
    }

    public function edit(Pinjaman $pinjaman): View
    {
        return view('pinjaman.edit', [
            'pinjaman' => $pinjaman,
            'anggotas' => Anggota::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, Pinjaman $pinjaman)
    {
        $data = $request->validate([
            'anggota_id' => ['required', 'exists:anggotas,id'],
            'nomor_pinjaman' => ['required', 'string', 'max:50', Rule::unique('pinjamans', 'nomor_pinjaman')->ignore($pinjaman->id)],
            'jumlah_pokok' => ['required', 'numeric', 'min:0'],
            'bunga_persen' => ['required', 'numeric', 'min:0'],
            'tenor_bulan' => ['required', 'integer', 'min:1'],
            'tanggal_cair' => ['required', 'date'],
            'jatuh_tempo' => ['required', 'date', 'after_or_equal:tanggal_cair'],
            'status' => ['required', Rule::in(['pengajuan', 'berjalan', 'lunas', 'ditolak'])],
            'keterangan' => ['nullable', 'string'],
        ]);

        $pinjaman->update($data);

        if ($request->filled('_modal')) {
            return back()->with('success', 'Pinjaman berhasil diperbarui.');
        }

        return redirect()->route('pinjaman.index')->with('success', 'Pinjaman berhasil diperbarui.');
    }

    public function destroy(Pinjaman $pinjaman)
    {
        $pinjaman->delete();

        return redirect()->route('pinjaman.index')->with('success', 'Pinjaman berhasil dihapus.');
    }
}
