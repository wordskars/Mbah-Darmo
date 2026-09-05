<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('franchise_packages', function (Blueprint $table) {
        $table->string('hero_image')->nullable()->after('color_accent');
    });
}

public function down(): void
{
    Schema::table('franchise_packages', function (Blueprint $table) {
        $table->dropColumn('hero_image');
    });
}
};
