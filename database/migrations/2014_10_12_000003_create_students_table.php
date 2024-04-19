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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('mssv', 10);
            $table->string('name');
            $table->string('class');
            $table->boolean('gender');
            $table->date('birthday');
            $table->string('telephone', 10);
            $table->string('image');
            $table->timestamps();
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
        Schema::dropIfExists('students');
    }
};
