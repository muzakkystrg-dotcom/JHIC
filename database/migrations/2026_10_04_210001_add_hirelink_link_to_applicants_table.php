<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Sambungkan pelamar portal (applicants) dengan alur Hirelink/SSO.
     *
     * - job_application_id : menunjuk ke baris `job_applications` (lamaran asli dari
     *   form pendaftaran alumni, berisi berkas CV/portofolio).
     * - source             : asal data pelamar ('hirelink' bila dari form publik,
     *   'seed' bila data contoh/seed).
     *
     * Dengan ini satu submit alumni bisa memunculkan baris `applicants` di banyak
     * mitra industri (fan-out), dan tiap mitra melihat kandidat yang sama.
     */
    public function up(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->foreignId('job_application_id')
                ->nullable()
                ->after('job_posting_id')
                ->constrained('job_applications')
                ->nullOnDelete();

            $table->string('source')->default('hirelink')->after('job_application_id');
        });

        // Baris yang sudah ada sebelum kolom ini dibuat semuanya berasal dari seeder,
        // bukan dari alur Hirelink. Tandai agar tidak tertukar.
        DB::table('applicants')->update(['source' => 'seed']);
    }

    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropForeign(['job_application_id']);
            $table->dropColumn(['job_application_id', 'source']);
        });
    }
};
