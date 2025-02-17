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
            $table->string('subject_code')->nullable();
            $table->string('subject_title');

            $table->boolean('is_major'); //if is major: check the subject department pivot to see which major it's attached to

            $table->integer('credited_units')->default(0);
            $table->integer('lec_hours')->default(0);
            $table->integer('lab_hours')->default(0);

            $table->boolean('special');
            $table->boolean('elective');
            $table->boolean('no_text_booklet');
            $table->boolean('is_not_wga');

            $table->foreignId('category_id');
            $table->integer('tuition_units')->default(0);

            // TODO: when making mock fees tables, put the pivot there
            /*$table->foreginId('attached_fees'); will need to do a pivot map for this*/

            $table->timestamps();
        });

        Schema::create('subject_department', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Subject::class);
            $table->foreignIdFor(Department::class);
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
