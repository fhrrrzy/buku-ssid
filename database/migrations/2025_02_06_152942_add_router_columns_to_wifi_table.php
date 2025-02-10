<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('wifis', function (Blueprint $table) {
            $table->string('user_router')->default('admin')->after('password');
            $table->string('password_router')->default('admin')->after('user_router');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wifis', function (Blueprint $table) {
            $table->dropColumn(['user_router', 'password_router']);
        });
    }
};
