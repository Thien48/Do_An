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
        Schema::create('duration', function (Blueprint $table) {
            $table->id();
            $table->dateTime('registration_start_date');
            $table->dateTime('registration_end_date');
            $table->dateTime('proposed_start_date');
            $table->dateTime('proposed_end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duration');
    }
};
