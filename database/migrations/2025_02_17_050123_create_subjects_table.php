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

            $table->foreginId('subject_group_id');
            $table->string('subject_code');
            $table->string('subject_title');

            $table->boolean('is_major'); //if is major: check the subject department pivot to see which major it's attached to

            $table->integer('credited_units');
            $table->integer('lec_hours');
            $table->integer('lab_hours');

            $table->boolean('special');
            $table->boolean('elective');
            $table->boolean('no_text_booklet');
            $table->boolean('is_not_wga');

            $table->foreignId('category_id');
            $table->integer('tuition_units');

            /*$table->foreginId('attached_fees'); NOTE: will need to do a pivot map for this*/

            $table->timestamps();
        });

        Schema::create('subject_department', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Subject::class);
            $table->foreignIdFor(Department::class);
        });


        /*TODO: need to populate these in seeders*/
        Schema::create('subject_groups', function (Blueprint $table) {
            $table->id();
            $table->title('title');
        });

        Schema::create('categories', function (Blueprint $table) {
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
