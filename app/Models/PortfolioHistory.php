<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PortfolioHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'value',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime',
        'value' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}