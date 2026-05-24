<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pinjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggotas')->cascadeOnDelete();
            $table->string('nomor_pinjaman')->unique();
            $table->decimal('jumlah_pokok', 15, 2);
            $table->decimal('bunga_persen', 5, 2)->default(0);
            $table->unsignedInteger('tenor_bulan');
            $table->date('tanggal_cair');
            $table->date('jatuh_tempo');
            $table->enum('status', ['pengajuan', 'berjalan', 'lunas', 'ditolak'])->default('pengajuan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjamans');
    }
};
