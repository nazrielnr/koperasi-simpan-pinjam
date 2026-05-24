<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('angsurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_id')->constrained('pinjamans')->cascadeOnDelete();
            $table->unsignedInteger('nomor_angsuran');
            $table->decimal('jumlah_bayar', 15, 2);
            $table->decimal('pokok', 15, 2)->default(0);
            $table->decimal('bunga', 15, 2)->default(0);
            $table->decimal('denda', 15, 2)->default(0);
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_bayar')->nullable();
            $table->enum('status', ['jatuh_tempo', 'dibayar', 'tertunda'])->default('jatuh_tempo');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('angsurans');
    }
};
