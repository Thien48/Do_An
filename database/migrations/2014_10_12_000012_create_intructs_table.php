<?php

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
        Schema::create('instructs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')
                ->constrained('topics')
                ->onDelete('cascade');
            $table->foreignId('lecturer_id')
                ->constrained('lecturers')
                ->onDelete('cascade');
            $table->foreignId('student_id')
                ->constrained('students')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intructs');
    }
};
