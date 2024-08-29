<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content');
            $table->timestamps();
        });

        DB::table('articles')->insert([
            ['title'=> 'Article 1', 'content' => 'this is the first article'],
            ['title'=> 'Article 2', 'content' => 'this is the second article'],
            ['title'=> 'Article 3', 'content' => 'this is the third article'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('article');
    }
};
