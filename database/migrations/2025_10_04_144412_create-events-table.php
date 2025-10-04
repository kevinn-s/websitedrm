<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('category')->nullable();
            
            // Native ENUM for event type (MySQL 8.0+)
            $table->enum('type', ['ANNUAL', 'SCHEDULED'])->default('SCHEDULED');

            $table->timestamp('published_at')->nullable();
            $table->date('event_date')->nullable();        // for SCHEDULED events
            $table->string('event_time')->nullable();      // e.g., "10:00 AM - 12:00 PM"
            $table->string('annual_month')->nullable();    // e.g., "October"
            $table->string('speaker_name')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};