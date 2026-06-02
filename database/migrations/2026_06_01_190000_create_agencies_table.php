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
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');                                       // Nome da agência (Ex: 14 BIS)
            $table->string('address');                                    // Logradouro completo
            $table->string('neighborhood');                               // Bairro
            $table->string('city');                                       // Cidade
            $table->string('state', 2);                                   // Estado (UF - 2 letras)
            $table->string('zip_code', 10)->nullable();                   // CEP
            $table->string('phone')->nullable();                          // Telefone
            $table->string('agency_number');                              // Número da agência (Ex: 0231-3)
            $table->string('opening_hours')->nullable();                  // Horário de atendimento
            $table->string('google_location_id')->nullable();             // ID do Google Business Profile (para API)
            $table->decimal('average_rating', 2, 1)->nullable();          // Nota média (1.0 - 5.0)
            $table->string('slug')->unique();                             // URL amigável para SEO
            $table->timestamps();
            $table->softDeletes();

            // Índices para busca por localidade (SEO Local)
            $table->index(['city', 'state']);
            $table->index('neighborhood');
            $table->index('agency_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
