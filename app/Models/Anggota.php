<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggotas';

    protected $fillable = [
        'nomor_anggota',
        'nama',
        'nik',
        'telepon',
        'alamat',
        'tanggal_gabung',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_gabung' => 'date',
        ];
    }

    public function simpanan(): HasMany
    {
        return $this->hasMany(Simpanan::class, 'anggota_id');
    }

    public function pinjaman(): HasMany
    {
        return $this->hasMany(Pinjaman::class, 'anggota_id');
    }
}
