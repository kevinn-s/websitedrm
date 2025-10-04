<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_accesses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            
            // Native ENUM for access type
            $table->enum('type', ['PHYSICAL', 'VIRTUAL', 'HYBRID']);

            $table->string('name')->nullable();            // e.g., "Main Hall", "Zoom Room"
            $table->string('address')->nullable();         // for PHYSICAL
            $table->string('map_url')->nullable();         // Google Maps link
            $table->string('meeting_url')->nullable();     // Zoom, Teams, etc.
            $table->string('meeting_passcode')->nullable();
            $table->timestamps();

            // Prevent duplicate access types per event
            $table->unique(['event_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_accesses');
    }
};