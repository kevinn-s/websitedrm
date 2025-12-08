<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('alumni_id')->constrained('alumni')->cascadeOnDelete();
            $table->foreignId('scholar_profile_id')->nullable()->constrained()->cascadeOnDelete();

            $table->string('title');
            $table->integer('year');
            $table->string('type');
            $table->text('authors')->nullable();
            $table->text('abstract')->nullable();

            $table->string('publisher')->nullable();
            $table->string('venue')->nullable();
            $table->string('volume')->nullable();
            $table->string('number')->nullable();
            $table->string('pages')->nullable();

            $table->string('doi')->nullable();
            $table->string('isbn')->nullable();
            $table->string('issn')->nullable();

            $table->string('gs_cluster_id')->nullable()->index();
            $table->string('article_link')->nullable();
            $table->string('url')->nullable();

            $table->integer('citation_count')->default(0);
            $table->json('keywords')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
