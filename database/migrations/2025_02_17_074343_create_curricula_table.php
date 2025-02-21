<?php

use App\Models\Course;
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
        Schema::create('curricula', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Course::class)
                ->cascadeOnDelete();
            $table->foreignIdFor(Department::class)
                ->cascadeOnDelete();

            $table->integer('year_implemented'); // should link to sy
            $table->year('start_year');
            $table->year('end_year');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curricula');
    }
};
