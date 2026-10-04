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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();

            // Detail lowongan
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('company');
            $table->string('category')->default('Full Time')->index();
            $table->string('location');
            $table->text('description')->nullable();
            $table->string('logo')->nullable();

            // Publikasi
            $table->timestamp('posted_at')->nullable()->index();
            $table->boolean('is_active')->default(true)->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
