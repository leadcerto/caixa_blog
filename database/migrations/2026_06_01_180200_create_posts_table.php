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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');                                          // H1 do artigo
            $table->string('slug')->unique();                                 // URL amigável
            $table->text('hook_excerpt')->nullable();                         // Gancho/Contexto rápido (destaque inicial)
            $table->longText('content');                                      // Desenvolvimento em rich text
            $table->string('featured_image')->nullable();                     // Imagem de capa
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();   // FK -> users
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete(); // FK -> categories
            $table->boolean('is_published')->default(false);                  // Status de publicação
            $table->timestamp('published_at')->nullable();                    // Data/hora de publicação
            $table->timestamps();
            $table->softDeletes();

            // Índices para queries frequentes
            $table->index(['is_published', 'published_at']);
            $table->index('author_id');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
