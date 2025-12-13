<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mutasi_aset', function (Blueprint $table) {
            $table->id('mutasi_id');
            $table->unsignedBigInteger('aset_id'); // FK ke aset
            $table->date('tanggal');
            $table->enum('jenis_mutasi', [
                'Pemindahan',
                'Penghapusan',
                'Perubahan Status',
                'Peminjaman',
                'Pengembalian'
            ]);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('aset_id')->references('aset_id')->on('aset')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mutasi_aset');
    }
};
