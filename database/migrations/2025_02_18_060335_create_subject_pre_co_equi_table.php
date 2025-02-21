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
        Schema::create('subject_pre_co_equi', function (Blueprint $table) {
            $table->id();

            $table->integer('type');
            $table->foreignIdFor(Subject::class)
                ->cascadeOnDelete();
            $table->foreignIdFor(Subject::class, 'dependent_subject_id')
                ->cascadeOnDelete();
            $table->foreignIdFor(Curriculum::class)
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_pre_co_equi');
    }
};
