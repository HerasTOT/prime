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
        Schema::create('entry_formats', function (Blueprint $table) {
            $table->id();
            $table->string('names');
            $table->string('first_surname');
            $table->string('second_surname')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->integer('age');
            $table->date('birthdate');
            $table->integer('ssn');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entry_formats');
    }
};
