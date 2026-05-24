<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Angsuran extends Model
{
    use HasFactory;

    protected $table = 'angsurans';

    protected $fillable = [
        'pinjaman_id',
        'nomor_angsuran',
        'jumlah_bayar',
        'pokok',
        'bunga',
        'denda',
        'tanggal_jatuh_tempo',
        'tanggal_bayar',
        'status',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'jumlah_bayar' => 'decimal:2',
            'pokok' => 'decimal:2',
            'bunga' => 'decimal:2',
            'denda' => 'decimal:2',
            'tanggal_jatuh_tempo' => 'date',
            'tanggal_bayar' => 'date',
        ];
    }

    public function pinjaman(): BelongsTo
    {
        return $this->belongsTo(Pinjaman::class, 'pinjaman_id');
    }
}
