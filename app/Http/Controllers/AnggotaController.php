<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AnggotaController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));
        $sortOptions = [
            'created_at' => 'Terbaru',
            'nama' => 'Nama',
            'nomor_anggota' => 'Nomor Anggota',
            'tanggal_gabung' => 'Tanggal Gabung',
            'status' => 'Status',
        ];
        $requestedSort = (string) $request->query('sort', 'created_at');
        $sort = array_key_exists($requestedSort, $sortOptions) ? $requestedSort : 'created_at';
        $direction = (string) $request->query('direction') === 'asc' ? 'asc' : 'desc';

        $anggotas = Anggota::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nomor_anggota', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%")
                        ->orWhere('telepon', 'like', "%{$search}%")
                        ->orWhere('alamat', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%");
                });
            })
            ->orderBy($sort, $direction)
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('anggota.index', [
            'anggotas' => $anggotas,
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
        return view('anggota.create', [
            'anggota' => new Anggota([
                'tanggal_gabung' => now()->toDateString(),
                'status' => 'aktif',
            ]),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor_anggota' => ['required', 'string', 'max:50', 'unique:anggotas,nomor_anggota'],
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['nullable', 'string', 'max:20', 'unique:anggotas,nik'],
            'telepon' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
            'tanggal_gabung' => ['required', 'date'],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);

        Anggota::create($data);

        if ($request->filled('_modal')) {
            return back()->with('success', 'Anggota berhasil ditambahkan.');
        }

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show(Anggota $anggota): View
    {
        $anggota->load(['simpanan', 'pinjaman.angsuran']);

        return view('anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota): View
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $data = $request->validate([
            'nomor_anggota' => ['required', 'string', 'max:50', Rule::unique('anggotas', 'nomor_anggota')->ignore($anggota->id)],
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['nullable', 'string', 'max:20', Rule::unique('anggotas', 'nik')->ignore($anggota->id)],
            'telepon' => ['nullable', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
            'tanggal_gabung' => ['required', 'date'],
            'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
        ]);

        $anggota->update($data);

        if ($request->filled('_modal')) {
            return back()->with('success', 'Anggota berhasil diperbarui.');
        }

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
