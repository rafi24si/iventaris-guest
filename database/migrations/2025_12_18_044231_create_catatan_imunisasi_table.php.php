<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('catatan_imunisasis', function (Blueprint $table) {
            $table->id('imunisasi_id');

            $table->unsignedBigInteger('warga_id');

            $table->string('jenis_vaksin', 100);
            $table->date('tanggal');
            $table->string('lokasi', 150)->nullable();
            $table->string('nakes', 150)->nullable();

            $table->timestamps();

            // FK → warga (ingat: tabel = warga, bukan wargas)
            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('warga')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catatan_imunisasis');
    }
};
