<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreatorLink extends Model
{
    protected $fillable = ['creator_id', 'title', 'url', 'position'];

    /**
     * Get the creator that owns this link.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(Creator::class);
    }
}
