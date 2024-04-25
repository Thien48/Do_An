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
        Schema::create('proposal_form', function (Blueprint $table) {
            $table->id();
            $table->date('proposed_date');
            $table->date('approval_date')->nullable();
            $table->string('name');
            $table->Text('introduce');
            $table->Text('target');
            $table->Text('request');
            $table->string('references');
            $table->boolean('status');
            $table->string('year');
            $table->foreignId('subject_id')
            ->constrained('subjects')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposal_form');
    }
};
