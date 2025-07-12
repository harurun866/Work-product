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
        Schema::create('practices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date')->nullable();              // 練習日
            $table->time('time')->nullable();              // 練習時間
            $table->string('instrument')->nullable();      // 楽器
            $table->string('genre')->nullable();           // 音楽ジャンル
            $table->text('content')->nullable();           // 練習内容
            $table->text('reflection')->nullable();        // 振り返り
            $table->string('next_goal')->nullable();       // 次の目標
            $table->text('memo')->nullable();              // メモ

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practices');
    }
};
