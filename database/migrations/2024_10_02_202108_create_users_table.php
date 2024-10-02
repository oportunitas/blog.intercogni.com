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
        Schema::create('users', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('github_id')->unique();
            $table->string('name')->nullable(); 
            $table->string('avatar')->nullable();
            $table->string('nickname')->nullable();
            $table->string('github_token')->nullable();
            $table->string('github_refresh_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
