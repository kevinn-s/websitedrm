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
        Schema::create('official_alumni', function (Blueprint $table) {
            $table->id();
            $table->integer('graduation_batch');
            $table->string('binusian_id');
            $table->string('student_id_1');
            $table->string('student_name');
            $table->date('legitimation_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offical_alumni');
    }
};