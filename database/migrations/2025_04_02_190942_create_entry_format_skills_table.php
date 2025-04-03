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
        Schema::create('entry_format_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entry_format_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_position_id')->constrained()->onDelete('cascade');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry_format_skills');
    }
};
