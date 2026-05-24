<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SimpananController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $sortOptions = [
            'tanggal_transaksi' => 'Tanggal Transaksi',
            'jumlah' => 'Jumlah',
            'jenis' => 'Jenis',
            'anggota' => 'Nama Anggota',
            'created_at' => 'Terbaru',
        ];
        $sortColumns = [
            'tanggal_transaksi' => 'simpanans.tanggal_transaksi',
            'jumlah' => 'simpanans.jumlah',
            'jenis' => 'simpanans.jenis',
            'created_at' => 'simpanans.created_at',
        ];
        $requestedSort = (string) $request->query('sort', 'tanggal_transaksi');
        $sort = array_key_exists($requestedSort, $sortOptions) ? $requestedSort : 'tanggal_transaksi';
        $direction = (string) $request->query('direction') === 'asc' ? 'asc' : 'desc';

        $query = Simpanan::with('anggota')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('jenis', 'like', "%{$search}%")
                        ->orWhere('jumlah', 'like', "%{$search}%")
                        ->orWhere('tanggal_transaksi', 'like', "%{$search}%")
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
                    ->whereColumn('anggotas.id', 'simpanans.anggota_id')
                    ->limit(1),
                $direction
            );
        } else {
            $query->orderBy($sortColumns[$sort], $direction);
        }

        return view('simpanan.index', [
            'simpanans' => $query->orderByDesc('simpanans.id')->paginate(10)->withQueryString(),
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
        return view('simpanan.create', [
            'simpanan' => new Simpanan([
                'jenis' => 'wajib',
                'tanggal_transaksi' => now()->toDateString(),
            ]),
            'anggotas' => Anggota::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'anggota_id' => ['required', 'exists:anggotas,id'],
            'jenis' => ['required', Rule::in(['pokok', 'wajib', 'sukarela'])],
            'jumlah' => ['required', 'numeric', 'min:0'],
            'tanggal_transaksi' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],
        ]);

        Simpanan::create($data);

        if ($request->filled('_modal')) {
            return back()->with('success', 'Transaksi simpanan berhasil disimpan.');
        }

        return redirect()->route('simpanan.index')->with('success', 'Transaksi simpanan berhasil disimpan.');
    }

    public function show(Simpanan $simpanan): View
    {
        $simpanan->load('anggota');

        return view('simpanan.show', compact('simpanan'));
    }

    public function edit(Simpanan $simpanan): View
    {
        return view('simpanan.edit', [
            'simpanan' => $simpanan,
            'anggotas' => Anggota::orderBy('nama')->get(),
        ]);
    }

    public function update(Request $request, Simpanan $simpanan)
    {
        $data = $request->validate([
            'anggota_id' => ['required', 'exists:anggotas,id'],
            'jenis' => ['required', Rule::in(['pokok', 'wajib', 'sukarela'])],
            'jumlah' => ['required', 'numeric', 'min:0'],
            'tanggal_transaksi' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $simpanan->update($data);

        if ($request->filled('_modal')) {
            return back()->with('success', 'Transaksi simpanan berhasil diperbarui.');
        }

        return redirect()->route('simpanan.index')->with('success', 'Transaksi simpanan berhasil diperbarui.');
    }

    public function destroy(Simpanan $simpanan)
    {
        $simpanan->delete();

        return redirect()->route('simpanan.index')->with('success', 'Transaksi simpanan berhasil dihapus.');
    }
}
