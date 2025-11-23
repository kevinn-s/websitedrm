
<?php

use App\Models\Event;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_accesses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Event::class)->constrained()->unique();
            $table->enum('type', ['PHYSICAL', 'VIRTUAL', 'HYBRID']);
            $table->string('name')->nullable();           
            $table->string('address')->nullable();
            $table->string('map_url')->nullable(); 
            $table->string('meeting_url')->nullable();
            $table->string('meeting_passcode')->nullable();
            $table->timestamps();
            $table->unique(['event_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_accesses');
    }
};