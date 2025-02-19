<?php

use App\Models\CurriculumSemester;
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
        Schema::create('curriculum_semester_subject', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(CurriculumSemester::class);
            $table->foreignIdFor(Subject::class);

            $table->foreignId('curriculum_semester_area_id');
            $table->float('quota');

            $table->timestamps();
        });

        Schema::create('curriculum_semester_areas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_semester_subject');
        Schema::dropIfExists('curriculum_semester_areas');
    }
};
