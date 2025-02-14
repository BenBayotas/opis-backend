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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->foreignId('program_type_id');
            $table->foreignId('dean_id');
            $table->foreignId('head_id');

            $table->timestamps();
        });


        Schema::create('program_types', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
        Schema::dropIfExists('program_types');
    }
};
