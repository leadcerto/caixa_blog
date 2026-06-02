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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();   // FK -> posts
            $table->string('title');                                          // Nome do recurso
            $table->string('file_path');                                      // Caminho do arquivo
            $table->string('type')->default('pdf');                           // Tipo: pdf, template, edital, planilha, etc.
            $table->timestamps();
            $table->softDeletes();

            $table->index('post_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
