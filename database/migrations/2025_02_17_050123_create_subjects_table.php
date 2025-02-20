<?php

use App\Models\Department;
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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('subject_group_id');
            $table->string('code')->nullable();
            $table->string('title');

            $table->boolean('is_major'); // WARN: this should be removed at some point, derived from department
            $table->foreignIdFor(Department::class)
                ->nullable()
                ->nullOnDelete();

            $table->integer('credited_units')->default(0);
            $table->integer('lec_hours')->default(0);
            $table->integer('lab_hours')->default(0);

            $table->boolean('special');
            $table->boolean('elective');
            $table->boolean('no_text_booklet');
            $table->boolean('is_not_wga');

            $table->foreignId('category_id');
            $table->integer('tuition_units')->default(0);


            $table->timestamps();
        });

        // NOTE: this seems to list all subject codes, so I might have to link
        // it to the subject table at some point
        Schema::create('subject_groups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });

        Schema::create('subject_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });

        Schema::create('subject_fee', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Subject::class);
            $table->foreignId('fee_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('subject_groups');
        Schema::dropIfExists('categories');
    }
};
