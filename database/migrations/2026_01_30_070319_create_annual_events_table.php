<?php

use App\Enums\EventAccess;
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
        Schema::create('annual_events', function (Blueprint $table) {
            $table->id();
            $table->ulid('event_id');
            $table->enum('type', [EventAccess::ONSITE->value, EventAccess::ONLINE->value, EventAccess::HYBRID->value])->nullable();
            $table->date('month');
            $table->json('images')->nullable();
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->cascadeOnDelete();
            $table->unique('event_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annual_events');
    }
};
