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
        Schema::create('intructs', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->dateTime('star_date');
            $table->dateTime('end_date');
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
