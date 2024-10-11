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
        Schema::create('apache_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->date('date');
            $table->time('time');
            $table->string('http_method');
            $table->string('request_url');
            $table->string('http_protocol');
            $table->integer('status_code');
            $table->integer('response_size');
            $table->string('user_agent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apache_logs');
    }
};
