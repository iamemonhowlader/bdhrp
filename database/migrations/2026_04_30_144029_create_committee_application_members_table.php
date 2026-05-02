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
        Schema::create('committee_application_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_application_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('nid')->nullable();
            $table->string('phone')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('role')->nullable();
            $table->string('address')->nullable();
            $table->string('profession')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('signature_path')->nullable();
            $table->string('member_id')->nullable();
            $table->boolean('is_lifetime')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_application_members');
    }
};
