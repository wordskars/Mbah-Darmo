<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'price', 'short_description_hover',
        'description', 'image', 'spice_level', 'is_available', 'is_featured'
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'is_featured'  => 'boolean',
        'price'        => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function salesTransactions()
    {
        return $this->hasMany(SalesTransaction::class);
    }

    public function getTotalSoldAttribute()
    {
        return $this->salesTransactions()->sum('quantity_sold');
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}
