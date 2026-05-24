<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => env('SEED_ADMIN_NAME', 'Admin Koperasi'),
                'username' => env('SEED_ADMIN_USERNAME', 'admin'),
                'email' => env('SEED_ADMIN_EMAIL', 'admin@koperasi.test'),
                'password' => env('SEED_ADMIN_PASSWORD'),
            ],
            [
                'name' => env('SEED_PETUGAS_NAME', 'Petugas Koperasi'),
                'username' => env('SEED_PETUGAS_USERNAME', 'petugas'),
                'email' => env('SEED_PETUGAS_EMAIL', 'petugas@koperasi.test'),
                'password' => env('SEED_PETUGAS_PASSWORD'),
            ],
            [
                'name' => env('SEED_BENDAHARA_NAME', 'Bendahara Koperasi'),
                'username' => env('SEED_BENDAHARA_USERNAME', 'bendahara'),
                'email' => env('SEED_BENDAHARA_EMAIL', 'bendahara@koperasi.test'),
                'password' => env('SEED_BENDAHARA_PASSWORD'),
            ],
        ];

        foreach ($users as $user) {
            if (empty($user['password'])) {
                throw new \RuntimeException("Seed password for {$user['username']} is not configured in .env.");
            }
        }

        foreach ($users as $user) {
            User::updateOrCreate(
                ['username' => $user['username']],
                [
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => Hash::make($user['password']),
                ]
            );
        }

        $anggotaData = [
            [
                'nomor_anggota' => 'AGT-001',
                'nama' => 'Budi Santoso',
                'nik' => '3174010101010001',
                'telepon' => '081234567890',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'tanggal_gabung' => '2025-01-10',
                'status' => 'aktif',
            ],
            [
                'nomor_anggota' => 'AGT-002',
                'nama' => 'Siti Aminah',
                'nik' => '3174010101010002',
                'telepon' => '081298765432',
                'alamat' => 'Jl. Melati No. 5, Bandung',
                'tanggal_gabung' => '2025-02-15',
                'status' => 'aktif',
            ],
            [
                'nomor_anggota' => 'AGT-003',
                'nama' => 'Andi Pratama',
                'nik' => '3174010101010003',
                'telepon' => '081377788899',
                'alamat' => 'Jl. Kenanga No. 21, Bekasi',
                'tanggal_gabung' => '2025-03-20',
                'status' => 'aktif',
            ],
            [
                'nomor_anggota' => 'AGT-004',
                'nama' => 'Dewi Lestari',
                'nik' => '3174010101010004',
                'telepon' => '082112223333',
                'alamat' => 'Jl. Mawar No. 8, Depok',
                'tanggal_gabung' => '2025-04-12',
                'status' => 'aktif',
            ],
            [
                'nomor_anggota' => 'AGT-005',
                'nama' => 'Rizky Maulana',
                'nik' => '3174010101010005',
                'telepon' => '085611112222',
                'alamat' => 'Jl. Cempaka No. 17, Tangerang',
                'tanggal_gabung' => '2025-05-05',
                'status' => 'nonaktif',
            ],
        ];

        $anggotas = collect($anggotaData)->mapWithKeys(function (array $data) {
            $anggota = Anggota::updateOrCreate(
                ['nomor_anggota' => $data['nomor_anggota']],
                $data
            );

            return [$data['nomor_anggota'] => $anggota];
        });

        $simpananData = [
            ['AGT-001', 'pokok', 500000, '2025-01-10', 'Simpanan pokok awal'],
            ['AGT-001', 'wajib', 100000, '2025-02-10', 'Simpanan wajib Februari'],
            ['AGT-001', 'sukarela', 250000, '2025-03-10', 'Simpanan sukarela'],
            ['AGT-002', 'pokok', 500000, '2025-02-15', 'Simpanan pokok awal'],
            ['AGT-002', 'wajib', 100000, '2025-03-15', 'Simpanan wajib Maret'],
            ['AGT-002', 'sukarela', 150000, '2025-04-15', 'Simpanan sukarela'],
            ['AGT-003', 'pokok', 500000, '2025-03-20', 'Simpanan pokok awal'],
            ['AGT-003', 'wajib', 100000, '2025-04-20', 'Simpanan wajib April'],
            ['AGT-004', 'pokok', 500000, '2025-04-12', 'Simpanan pokok awal'],
            ['AGT-004', 'sukarela', 300000, '2025-05-12', 'Simpanan sukarela'],
            ['AGT-005', 'pokok', 500000, '2025-05-05', 'Simpanan pokok awal'],
        ];

        foreach ($simpananData as [$nomorAnggota, $jenis, $jumlah, $tanggal, $keterangan]) {
            Simpanan::updateOrCreate(
                [
                    'anggota_id' => $anggotas[$nomorAnggota]->id,
                    'jenis' => $jenis,
                    'jumlah' => $jumlah,
                    'tanggal_transaksi' => $tanggal,
                ],
                ['keterangan' => $keterangan]
            );
        }

        $pinjamanData = [
            [
                'nomor_pinjaman' => 'PJM-001',
                'nomor_anggota' => 'AGT-002',
                'jumlah_pokok' => 5000000,
                'bunga_persen' => 1.5,
                'tenor_bulan' => 12,
                'tanggal_cair' => '2025-03-01',
                'jatuh_tempo' => '2026-03-01',
                'status' => 'berjalan',
                'keterangan' => 'Modal usaha warung',
            ],
            [
                'nomor_pinjaman' => 'PJM-002',
                'nomor_anggota' => 'AGT-003',
                'jumlah_pokok' => 3000000,
                'bunga_persen' => 1.25,
                'tenor_bulan' => 10,
                'tanggal_cair' => '2025-04-05',
                'jatuh_tempo' => '2026-02-05',
                'status' => 'berjalan',
                'keterangan' => 'Biaya pendidikan',
            ],
            [
                'nomor_pinjaman' => 'PJM-003',
                'nomor_anggota' => 'AGT-004',
                'jumlah_pokok' => 2000000,
                'bunga_persen' => 1.0,
                'tenor_bulan' => 8,
                'tanggal_cair' => '2025-05-10',
                'jatuh_tempo' => '2026-01-10',
                'status' => 'pengajuan',
                'keterangan' => 'Renovasi rumah',
            ],
            [
                'nomor_pinjaman' => 'PJM-004',
                'nomor_anggota' => 'AGT-001',
                'jumlah_pokok' => 1500000,
                'bunga_persen' => 1.0,
                'tenor_bulan' => 6,
                'tanggal_cair' => '2025-01-15',
                'jatuh_tempo' => '2025-07-15',
                'status' => 'lunas',
                'keterangan' => 'Pembelian peralatan kerja',
            ],
        ];

        $pinjamans = collect($pinjamanData)->mapWithKeys(function (array $data) use ($anggotas) {
            $nomorAnggota = $data['nomor_anggota'];
            unset($data['nomor_anggota']);

            $pinjaman = Pinjaman::updateOrCreate(
                ['nomor_pinjaman' => $data['nomor_pinjaman']],
                array_merge($data, ['anggota_id' => $anggotas[$nomorAnggota]->id])
            );

            return [$data['nomor_pinjaman'] => $pinjaman];
        });

        $angsuranData = [
            ['PJM-001', 1, 450000, 400000, 50000, 0, '2025-04-01', '2025-04-01', 'dibayar', 'Angsuran pertama'],
            ['PJM-001', 2, 450000, 400000, 50000, 0, '2025-05-01', '2025-05-02', 'dibayar', 'Angsuran kedua'],
            ['PJM-001', 3, 450000, 400000, 50000, 0, '2025-06-01', null, 'jatuh_tempo', 'Menunggu pembayaran'],
            ['PJM-002', 1, 337500, 300000, 37500, 0, '2025-05-05', '2025-05-05', 'dibayar', 'Angsuran pertama'],
            ['PJM-002', 2, 337500, 300000, 37500, 10000, '2025-06-05', null, 'tertunda', 'Terlambat pembayaran'],
            ['PJM-004', 1, 265000, 250000, 15000, 0, '2025-02-15', '2025-02-15', 'dibayar', 'Angsuran lunas 1'],
            ['PJM-004', 2, 265000, 250000, 15000, 0, '2025-03-15', '2025-03-15', 'dibayar', 'Angsuran lunas 2'],
            ['PJM-004', 3, 265000, 250000, 15000, 0, '2025-04-15', '2025-04-15', 'dibayar', 'Angsuran lunas 3'],
            ['PJM-004', 4, 265000, 250000, 15000, 0, '2025-05-15', '2025-05-15', 'dibayar', 'Angsuran lunas 4'],
            ['PJM-004', 5, 265000, 250000, 15000, 0, '2025-06-15', '2025-06-15', 'dibayar', 'Angsuran lunas 5'],
            ['PJM-004', 6, 265000, 250000, 15000, 0, '2025-07-15', '2025-07-15', 'dibayar', 'Angsuran lunas 6'],
        ];

        foreach ($angsuranData as [$nomorPinjaman, $nomorAngsuran, $jumlahBayar, $pokok, $bunga, $denda, $jatuhTempo, $tanggalBayar, $status, $keterangan]) {
            Angsuran::updateOrCreate(
                [
                    'pinjaman_id' => $pinjamans[$nomorPinjaman]->id,
                    'nomor_angsuran' => $nomorAngsuran,
                ],
                [
                    'jumlah_bayar' => $jumlahBayar,
                    'pokok' => $pokok,
                    'bunga' => $bunga,
                    'denda' => $denda,
                    'tanggal_jatuh_tempo' => $jatuhTempo,
                    'tanggal_bayar' => $tanggalBayar,
                    'status' => $status,
                    'keterangan' => $keterangan,
                ]
            );
        }
    }
}
