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
        if (Schema::hasTable('hsk_words')) {
            return;
        }

        Schema::create('hsk_words', function (Blueprint $table) {
            $table->id();
            $table->string('chinese')->charset('utf8mb4');
            $table->string('pinyin')->charset('utf8mb4');
            $table->string('pinyin_with_tone')->charset('utf8mb4');
            $table->string('japanese_meaning')->charset('utf8mb4');
            $table->integer('hsk_level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hsk_words');
    }
};
