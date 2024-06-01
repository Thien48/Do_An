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

        Schema::table('subject_types', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('topic_proposals', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('topics', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('instructions', function (Blueprint $table) {
            $table->timestamps();
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
