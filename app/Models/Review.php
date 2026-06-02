<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'agency_id',
    'google_review_id',
    'reviewer_name',
    'rating',
    'comment',
    'reply',
    'review_date',
])]
class Review extends Model
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
            'rating'      => 'integer',
            'review_date' => 'datetime',
            'created_at'  => 'datetime',
            'updated_at'  => 'datetime',
            'deleted_at'  => 'datetime',
        ];
    }

    // ─── Relacionamentos ────────────────────────────────────────────────

    /**
     * Agência à qual esta avaliação pertence.
     */
    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class);
    }
}
