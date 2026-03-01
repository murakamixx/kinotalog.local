<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->integer('release_year')->nullable();
            $table->string('director', 255)->nullable();
            $table->text('actors')->nullable();
            $table->integer('duration')->nullable()->comment('Длительность в минутах');
            $table->decimal('rating', 3, 1)->nullable();
            $table->string('poster_url', 500)->nullable();
            $table->string('video_url', 500)->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            
            // Индексы
            $table->index('release_year');
            $table->index('created_at');
            $table->fullText(['title', 'description']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};