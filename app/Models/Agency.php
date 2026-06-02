<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'name',
    'address',
    'neighborhood',
    'city',
    'state',
    'zip_code',
    'phone',
    'agency_number',
    'opening_hours',
    'google_location_id',
    'average_rating',
    'slug',
])]
class Agency extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'average_rating' => 'decimal:1',
            'created_at'     => 'datetime',
            'updated_at'     => 'datetime',
            'deleted_at'     => 'datetime',
        ];
    }

    // ─── Accessors ──────────────────────────────────────────────────────

    /**
     * Email da agência — gerado dinamicamente a partir do agency_number.
     *
     * Regra de negócio: extrai os 4 primeiros dígitos numéricos do
     * agency_number e retorna ag{numeros}@caixa.gov.br
     *
     * Exemplo: agency_number = "0231-3" → email = "ag0231@caixa.gov.br"
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                // Extrai apenas dígitos e pega os 4 primeiros
                $digits = preg_replace('/\D/', '', $this->agency_number);
                $prefix = substr($digits, 0, 4);

                return "ag{$prefix}@caixa.gov.br";
            },
        );
    }

    /**
     * Título otimizado para SEO Local.
     * Formato: "Imóveis Caixa {Bairro} {Cidade} {Estado}"
     */
    protected function seoTitle(): Attribute
    {
        return Attribute::make(
            get: fn (): string => "Imóveis Caixa {$this->neighborhood} {$this->city} {$this->state}",
        );
    }

    // ─── Relacionamentos ────────────────────────────────────────────────

    /**
     * Avaliações (reviews) desta agência.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
