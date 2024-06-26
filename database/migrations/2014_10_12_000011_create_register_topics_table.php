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
        Schema::create('register_topics', function (Blueprint $table) {
            $table->id();
            $table->dateTime('registration_date');
            $table->foreignId('student_id')
            ->constrained('students')
            ->onDelete('cascade');
            $table->foreignId('topic_id')
            ->constrained('topics')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('register_topics');
    }
};
