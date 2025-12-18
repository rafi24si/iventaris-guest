<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jadwal_posyandus', function (Blueprint $table) {
            $table->id('jadwal_id');

            $table->unsignedBigInteger('posyandu_id');
            $table->date('tanggal');
            $table->string('tema', 150);
            $table->text('keterangan')->nullable();

            $table->timestamps();

            // FK ke posyandu
            $table->foreign('posyandu_id')
                  ->references('posyandu_id')
                  ->on('posyandus')
                  ->cascadeOnDelete();

            // Index untuk query cepat
            $table->index(['posyandu_id', 'tanggal']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_posyandus');
    }
};
