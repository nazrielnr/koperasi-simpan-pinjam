<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjamans';

    protected $fillable = [
        'anggota_id',
        'nomor_pinjaman',
        'jumlah_pokok',
        'bunga_persen',
        'tenor_bulan',
        'tanggal_cair',
        'jatuh_tempo',
        'status',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_pokok' => 'decimal:2',
            'bunga_persen' => 'decimal:2',
            'tanggal_cair' => 'date',
            'jatuh_tempo' => 'date',
        ];
    }

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function angsuran(): HasMany
    {
        return $this->hasMany(Angsuran::class, 'pinjaman_id');
    }
}
