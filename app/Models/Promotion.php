<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'discount_type', 'discount_value',
        'banner_image', 'source', 'ai_strategy_text', 'is_active', 'valid_until'
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'valid_until' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
