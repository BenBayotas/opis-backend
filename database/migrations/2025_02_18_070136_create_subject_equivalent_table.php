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
        Schema::create('subject_equivalent', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Subject::class);
            $table->foreignIdFor(Subject::class, 'equivalent_id');
            $table->foreignIdFor(Curriculum::class);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_equivalent');
    }
};
