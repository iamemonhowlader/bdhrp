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
        Schema::create('videos', function (Blueprint $header) {
            $header->id();
            $header->string('title');
            $header->string('url', 1024);
            $header->string('video_id')->nullable(); // For extracted youtube ID
            $header->string('duration')->nullable();
            $header->integer('sort_order')->default(0);
            $header->boolean('status')->default(true);
            $header->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
