<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id', 'quantity_sold', 'revenue', 'transaction_date', 'notes'
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'revenue'          => 'decimal:2',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
