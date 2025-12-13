<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemeliharaan_aset', function (Blueprint $table) {
            $table->id('pemeliharaan_id');

            $table->foreignId('aset_id')
                ->constrained('aset', 'aset_id')
                ->onDelete('cascade');

            $table->date('tanggal');
            $table->text('tindakan');
            $table->decimal('biaya', 15, 2);
            $table->string('pelaksana');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeliharaan_aset');
    }
};
