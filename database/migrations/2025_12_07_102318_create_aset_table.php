<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aset', function (Blueprint $table) {
            $table->id('aset_id');
            $table->unsignedBigInteger('kategori_id'); // FK kategori
            $table->string('kode_aset')->unique();
            $table->string('nama_aset');
            $table->date('tgl_perolehan');
            $table->decimal('nilai_perolehan', 15, 2);
            $table->enum('kondisi', ['Baik', 'Rusak Ringan', 'Rusak Berat']);
            $table->timestamps();

            // Foreign key menuju kategori_aset
            $table->foreign('kategori_id')->references('kategori_id')->on('kategori_aset');

            // === RELASI MEDIA (NO FK needed) ===
            // Media memakai ref_table='aset' dan ref_id=aset_id
            // sehingga kolom baru TIDAK diperlukan di tabel aset.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aset');
    }
};
