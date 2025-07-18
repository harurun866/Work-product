<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_chatrooms', function (Blueprint $table) {
            $table->string('status')->default('active'); // 'active' or 'away'
        });
    }

    public function down()
    {
        Schema::table('user_chatrooms', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
