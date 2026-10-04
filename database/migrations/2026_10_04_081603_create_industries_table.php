<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('industries', function (Blueprint $table) {
            $table->id();
            $table->string('industry_id')->unique(); // ID Industri (misal: IND-GARUDA-01)
            $table->string('company_name');
            $table->string('password');
            $table->string('logo')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('industries');
    }
};