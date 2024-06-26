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
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->string('msgv', 7)->unique();
            $table->string('name');
            $table->string('telephone', 10);
            $table->string('degree');
            $table->boolean('gender');
            $table->string('image');
            $table->string('department_id');
            $table->foreign('department_id') 
              ->references('department_id') 
              ->on('departments')
              ->onDelete('cascade');
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};
