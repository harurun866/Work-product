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
        //Schema::create('events', function (Blueprint $table) {
        //$table->id();
        // $table->timestamps();
        // $table->foreignId('user_id')->constrained()->onDelete('cascade');
        //$table->text('body')->nullable();          // イベント内容
        //$table->boolean('is_planned')->default(0); // 予定済みかどうか
        //$table->date('date')->nullable();          // イベント日
        //});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('events');
    }
};
