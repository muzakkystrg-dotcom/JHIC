<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah `slug` pada mitra industri.
     *
     * Dipakai untuk memetakan perusahaan/mitra secara stabil (job_vacancies.company,
     * config/mitra) tanpa bergantung pada penulisan nama yang bisa berbeda-beda.
     */
    public function up(): void
    {
        Schema::table('industries', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('industry_id');
        });
    }

    public function down(): void
    {
        Schema::table('industries', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
