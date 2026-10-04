<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('industry_id')->constrained('industries')->onDelete('cascade');
            $table->foreignId('job_posting_id')->nullable()->constrained('job_postings')->onDelete('set null');
            $table->string('sso_number');
            $table->string('full_name');
            $table->string('major')->default('SIJA');
            $table->string('dtp')->default('2023/2024');
            $table->string('email');
            $table->string('phone');
            $table->string('linkedin_url')->nullable();
            $table->json('skills')->nullable();
            $table->integer('ai_match_score')->default(85);
            $table->string('work_preference')->default('On-Site');
            $table->enum('status', ['pending', 'interview', 'accepted', 'rejected'])->default('pending');
            $table->text('interview_details')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};