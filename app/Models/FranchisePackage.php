<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FranchisePackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'price', 'space_required', 'pax_capacity',
        'roi_projection', 'description', 'highlights', 'menu_list',
        'layout_images', 'staff_count', 'monthly_revenue_estimate',
        'financial_breakdown', 'color_accent', 'sort_order',
        'hero_image', // <--- Tambahkan ini
    ];

    protected $casts = [
        'highlights' => 'array',
        'menu_list' => 'array',
        'layout_images' => 'array',
        'financial_breakdown' => 'array',
        'price' => 'decimal:2',
    ];

    public function getFormattedPriceAttribute()
    {
        return 'Rp '.number_format($this->price, 0, ',', '.');
    }

    public function getWhatsappUrlAttribute()
    {
        $text = urlencode("Halo Tim Mbah Darmo, saya tertarik untuk bergabung Kemitraan Paket {$this->name}");

        return "https://wa.me/6281215142908?text={$text}";
    }

    // Helper URL Gambar Background
    public function getHeroImageUrlAttribute()
    {
        if ($this->hero_image && Storage::disk('public')->exists($this->hero_image)) {
            return asset('storage/'.$this->hero_image);
        }

        // Default gambar fallback jika admin tidak mengunggah gambar
        return asset('images/home/kemitraan/franchise.jpg');
    }
}
