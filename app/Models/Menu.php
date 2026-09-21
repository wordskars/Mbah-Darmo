<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    protected $appends = ['image_url', 'formatted_price'];

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

    public function getImageUrlAttribute()
    {
        if (!empty($this->image)) {
            if (Str::startsWith($this->image, ['http://', 'https://'])) {
                return $this->image;
            }
            if (file_exists(public_path($this->image))) {
                return asset($this->image);
            }
            if (file_exists(public_path('storage/' . $this->image))) {
                return asset('storage/' . $this->image);
            }
        }

        // Smart fallback to authentic culinary photos in public/images/home/menu/
        $slug = strtolower(($this->slug ?? '') . ' ' . ($this->name ?? ''));
        if (str_contains($slug, 'sate')) {
            return asset('images/home/menu/satekambing.jpg');
        } elseif (str_contains($slug, 'nasi') || str_contains($slug, 'goreng')) {
            return asset('images/home/menu/nasigorengayam.jpg');
        } elseif (str_contains($slug, 'mie') || str_contains($slug, 'bakmie') || str_contains($slug, 'gepeng') || str_contains($slug, 'bihun') || str_contains($slug, 'kwetiau')) {
            return asset('images/home/menu/bakmiegorengayam.jpg');
        } elseif (str_contains($slug, 'kikil') || str_contains($slug, 'koyor') || str_contains($slug, 'babat') || str_contains($slug, 'oseng') || str_contains($slug, 'gongso') || str_contains($slug, 'krengsengan')) {
            return asset('images/home/menu/osengkoyor.jpg');
        } elseif (str_contains($slug, 'kopi')) {
            return asset('images/home/menu/kopitubruk.jpg');
        } elseif (str_contains($slug, 'ronde') || str_contains($slug, 'wedang') || str_contains($slug, 'jahe') || str_contains($slug, 'uwuh') || str_contains($slug, 'jeruk') || str_contains($slug, 'asem')) {
            return asset('images/home/menu/wedangronderempah.jpg');
        } elseif (str_contains($slug, 'tongseng') || str_contains($slug, 'tengkleng') || str_contains($slug, 'gulai')) {
            return asset('images/home/menu/tongseng.jpg');
        }

        return asset('images/home/menu/IMG_4608.jpg');
    }
}
