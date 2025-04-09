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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('company');
            $table->string('supervisor');
            $table->string('address');
            $table->string('company_phone');
            $table->decimal('salary',11,2);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('termination_reason')->nullable();
            $table->foreignId('entry_format_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
