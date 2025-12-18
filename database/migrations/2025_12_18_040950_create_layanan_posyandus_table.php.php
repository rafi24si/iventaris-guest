<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('layanan_posyandus', function (Blueprint $table) {
            $table->id('layanan_id');

            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('warga_id');

            $table->decimal('berat', 5, 2)->nullable();   // kg
            $table->decimal('tinggi', 5, 2)->nullable();  // cm
            $table->string('vitamin', 100)->nullable();
            $table->text('konseling')->nullable();

            $table->timestamps();

            // FK
            $table->foreign('jadwal_id')
                ->references('jadwal_id')
                ->on('jadwal_posyandus')
                ->cascadeOnDelete();

            $table->foreign('warga_id')
                ->references('warga_id')
                ->on('warga')
                ->cascadeOnDelete();

            // satu warga hanya 1 layanan per jadwal
            $table->unique(['jadwal_id', 'warga_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan_posyandus');
    }
};
