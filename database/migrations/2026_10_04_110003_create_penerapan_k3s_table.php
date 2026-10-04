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
        Schema::create('penerapan_k3s', function (Blueprint $table) {
            $table->id();

            // Dokumen K3
            $table->string('nama_file');
            $table->string('slug')->unique();
            $table->string('file_size')->nullable();
            $table->string('file_path')->nullable();
            $table->date('uploaded_at')->nullable()->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerapan_k3s');
    }
};
