<?php

use App\Models\CurriculumYear;
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
        Schema::create('curriculum_semesters', function (Blueprint $table) {
            $table->id();

            $table->string('title'); // NOTE: hardcode string result
            $table->foreignIdFor(CurriculumYear::class)
                ->cascadeOnDelete();;

            // NOTE: able to change the "area" version when ched decides
            // to change it without affecting older ones
            // like '2324 area' in curriculum
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum_semesters');
    }
};
