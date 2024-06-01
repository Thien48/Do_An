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
        Schema::create('topic_proposals', function (Blueprint $table) {
            $table->id();
            $table->date('proposed_date');
            $table->date('approval_date')->nullable();
            $table->Text('name_proposal');
            $table->Text('target');
            $table->Text('request');
            $table->Text('references');
            $table->boolean('status');
            $table->string('year');
            $table->Text('feedback')->nullable();
            $table->foreignId('subject_id')
            ->constrained('subject_types')
            ->onDelete('cascade');
            $table->foreignId('lecturer_id')
            ->constrained('lecturers')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topic_proposals');
    }
};
