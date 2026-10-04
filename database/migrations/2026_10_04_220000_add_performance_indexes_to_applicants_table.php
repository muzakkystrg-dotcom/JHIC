<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Index untuk mempercepat query dashboard mitra industri dan
     * mendukung idempotensi fan-out lamaran (upsert).
     *
     * - (industry_id, job_application_id) unique : satu baris pelamar per mitra
     *   per lamaran -> dipakai `Applicant::upsert()`; sekaligus mencegah
     *   duplikat saat submit Ulang / job retry.
     * - (industry_id, status) : dashboard menghitung kandidat `pending` dan
     *   `accepted` per mitra (sebelumnya full scan).
     * - ai_match_score : daftar pelamar diurutkan `orderByDesc('ai_match_score')`.
     */
    public function up(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->unique(['industry_id', 'job_application_id'], 'applicants_industry_application_unique');
            $table->index(['industry_id', 'status'], 'applicants_industry_status_index');
            $table->index('ai_match_score', 'applicants_ai_match_score_index');
        });
    }

    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropUnique('applicants_industry_application_unique');
            $table->dropIndex('applicants_industry_status_index');
            $table->dropIndex('applicants_ai_match_score_index');
        });
    }
};
