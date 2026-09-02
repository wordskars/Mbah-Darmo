<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('discount_type')->nullable(); // percentage, fixed, bundling
            $table->string('discount_value')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('source')->default('manual'); // manual, ai_generated
            $table->text('ai_strategy_text')->nullable(); // raw AI suggestion
            $table->boolean('is_active')->default(true);
            $table->date('valid_until')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
