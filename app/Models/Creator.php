<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Creator extends Model
{
    protected $fillable = ['user_id', 'slug', 'display_name', 'bio', 'avatar_url'];

    /**
     * Get the user that owns the creator profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the links associated with the creator.
     */
    public function links(): HasMany
    {
        return $this->hasMany(CreatorLink::class)->orderBy('position');
    }

    /**
     * Get the supports received by the creator.
     */
    public function supports(): HasMany
    {
        return $this->hasMany(Support::class)->orderByDesc('created_at');
    }

    /**
     * Get the total amount of supports received.
     */
    public function getTotalSupports(): int
    {
        return $this->supports()->count();
    }

    /**
     * Get the total amount in CLP from supports.
     */
    public function getTotalAmount(): float
    {
        return (float) $this->supports()->sum('amount');
    }
}
