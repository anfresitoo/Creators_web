<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Support extends Model
{
    protected $fillable = ['creator_id', 'supporter_name', 'message', 'amount'];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    /**
     * Get the creator that receives this support.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(Creator::class);
    }
}
