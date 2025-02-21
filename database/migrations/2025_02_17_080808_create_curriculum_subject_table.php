<?php

use App\Models\Curriculum;
use App\Models\Subject;
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
        Schema::create('curriculum_subject', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Curriculum::class)
                ->cascadeOnDelete();
            $table->foreignIdFor(Subject::class)
                ->cascadeOnDelete();

            $table->integer('year_level');
            $table->integer('semester'); // should link to ref table

            $table->float('quota');
            $table->foreignId('subject_area_id');

            $table->timestamps();
        });

        Schema::create('subject_areas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_subject');
        Schema::dropIfExists('subject_areas');
    }
};
