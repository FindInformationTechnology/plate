<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OtpCode extends Model
{
    protected $fillable = [
        'identifier',
        'code',
        'type',
        'channel',
        'expires_at',
        'verified_at',
        'attempts',
    ];

    protected $casts = [
        'expires_at'  => 'datetime',
        'verified_at' => 'datetime',
        'attempts'    => 'integer',
    ];

    protected $hidden = ['code'];

    // ─── Scopes ─────────────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->whereNull('verified_at')
                     ->where('expires_at', '>', now());
    }

    public function scopeForIdentifier($query, string $identifier)
    {
        return $query->where('identifier', $identifier);
    }

    // ─── Helpers ────────────────────────────────────────────────────────────────

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function isVerified(): bool
    {
        return ! is_null($this->verified_at);
    }

    public function hasExceededAttempts(int $max = 5): bool
    {
        return $this->attempts >= $max;
    }

    public function markVerified(): void
    {
        $this->update(['verified_at' => now()]);
    }

    public function incrementAttempts(): void
    {
        $this->increment('attempts');
    }
}
