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
        Schema::create('votes', function (Blueprint $table) {
            $table->string('user_email');
            $table->unsignedBigInteger('blog_id');
            $table->integer('vote_type');
            $table->timestamps();

            $table->primary(['user_email', 'blog_id']);
            $table->foreign('user_email')
                ->references('email')->on('users')
                ->onDelete('cascade');
            $table->foreign('blog_id')
                ->references('id')->on('blogs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
