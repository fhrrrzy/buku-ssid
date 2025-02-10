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
        Schema::create('wifis', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('type');
            $table->string('serial_number')->unique();
            $table->string('mac_address')->unique();
            $table->string('ssid');
            $table->string('password');
            $table->text('description')->nullable();
            $table->foreignId('opd_id')->constrained('opds')->onDelete('cascade');
            $table->foreignId('bidang_id')->constrained('bidangs')->onDelete('cascade');
            $table->json('photos')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wifis');
    }
};
