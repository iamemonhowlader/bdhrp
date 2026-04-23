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
        Schema::create('committee_applications', function (Blueprint $table) {
            $table->id();
            $table->string('committee_type');
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('thana')->nullable();
            $table->string('union')->nullable();
            $table->string('area')->nullable();
            $table->string('city_corporation')->nullable();
            $table->string('ward')->nullable();
            $table->json('members')->nullable();
            $table->decimal('total_fee', 10, 2)->default(0);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_applications');
    }
};
