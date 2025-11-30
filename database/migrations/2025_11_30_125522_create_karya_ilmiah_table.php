<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Alumni;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karya_ilmiah', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Alumni::class)->constrained()->onDelete('cascade');
            $table->string("judul");
            $table->string("jenis")->nullable();
            $table->string("tahun_publikasi");
            $table->string('tautan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karya_ilmiah');
    }
};
