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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            // Identitas pelamar (SSO opsional, terisi kalau lewat verifikasi SSO)
            $table->string('sso')->nullable()->index();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone', 30);
            $table->string('linkedin')->nullable();

            // Berkas (path relatif di disk privat: storage/app/private)
            $table->string('resume_path')->nullable();
            $table->string('portfolio_path')->nullable();

            // Hard skill yang dipilih (disimpan sebagai JSON array)
            $table->json('skills')->nullable();

            // Preferensi karier
            $table->string('job_interest')->nullable();
            $table->string('work_preference')->default('On-Site');
            $table->date('start_date')->nullable();

            // Status review oleh admin
            $table->string('status')->default('pending')->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
