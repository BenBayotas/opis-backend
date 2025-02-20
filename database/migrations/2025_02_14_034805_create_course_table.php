<?php

use App\Models\Department;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Department::class)
                ->onDelete('cascade');

            $table->string('code');
            $table->string('acronym');

            $table->string('description');
            $table->string('major')->nullable();

            $table->string('authority_no')->nullable();
            $table->string('accreditation_id')->nullable();

            $table->year('year_granted')->nullable();
            $table->integer('years');

            $table->integer('slots');
            /*$table->foreignId('discipline');*/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
