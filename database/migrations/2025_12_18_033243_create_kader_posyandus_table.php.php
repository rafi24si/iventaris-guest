<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('kader_posyandus', function (Blueprint $table) {
            $table->id('kader_id');

            $table->unsignedBigInteger('posyandu_id');
            $table->unsignedBigInteger('warga_id');

            $table->string('peran', 100);
            $table->date('mulai_tugas');
            $table->date('akhir_tugas')->nullable();

            $table->timestamps();

            // FK ke POSYANDU
            $table->foreign('posyandu_id')
                ->references('posyandu_id')
                ->on('posyandus')
                ->cascadeOnDelete();

            // FK ke WARGA (INI YANG FIX)
            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('warga') // ✅ BENAR
                ->cascadeOnDelete();

            // Cegah satu warga jadi kader dobel di posyandu yang sama
            $table->unique(['posyandu_id', 'warga_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kader_posyandus');
    }
};
