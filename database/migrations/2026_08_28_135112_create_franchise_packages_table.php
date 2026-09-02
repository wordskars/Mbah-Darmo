<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('franchise_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // EXPRESS, BASIC, SIGNATURE, HERITAGE
            $table->string('slug')->unique();
            $table->decimal('price', 15, 2);
            $table->string('space_required')->nullable(); // e.g. "30-50 m²"
            $table->integer('pax_capacity')->nullable();
            $table->string('roi_projection')->nullable(); // e.g. "18-24 bulan"
            $table->text('description')->nullable();
            $table->text('highlights')->nullable(); // JSON array of highlight points
            $table->text('menu_list')->nullable(); // JSON array of included menus
            $table->text('layout_images')->nullable(); // JSON array of image paths
            $table->integer('staff_count')->nullable();
            $table->string('monthly_revenue_estimate')->nullable();
            $table->text('financial_breakdown')->nullable(); // JSON: hpp%, labor%, rent%, royalty%
            $table->string('color_accent')->nullable(); // For card styling
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('franchise_packages');
    }
};
