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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agency_id')->constrained()->cascadeOnDelete();
            $table->string('google_review_id')->unique();                 // ID único da review no Google
            $table->string('reviewer_name');                              // Nome do avaliador
            $table->unsignedTinyInteger('rating');                        // Nota 1-5 estrelas
            $table->text('comment')->nullable();                          // Comentário do avaliador
            $table->text('reply')->nullable();                            // Resposta do administrador
            $table->timestamp('review_date')->nullable();                 // Data da avaliação
            $table->timestamps();
            $table->softDeletes();

            $table->index('agency_id');
            $table->index('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
