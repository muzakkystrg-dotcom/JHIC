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
        Schema::create('trial_classes', function (Blueprint $table) {
            $table->id();

            // Jadwal sesi trial class
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('jurusan')->index();
            $table->date('tanggal');
            $table->string('jam');
            $table->string('instruktur');
            $table->unsignedInteger('kuota')->default(0);
            $table->boolean('is_active')->default(true)->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trial_classes');
    }
};
