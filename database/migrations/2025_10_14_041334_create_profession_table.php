<?php

use App\Models\Alumni;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profession', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Alumni::class)->constrained()->onDelete('cascade');
            $table->string('profession');
            $table->string('company')->nullable();
            $table->string('city');
            $table->string('province');
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
