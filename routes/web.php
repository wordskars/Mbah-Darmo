<?php

use App\Http\Controllers\Admin\AiAssistantController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FranchiseController as AdminFranchiseController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\SalesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FranchiseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

// ─── PUBLIC ROUTES ────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/franchise', [FranchiseController::class, 'index'])->name('franchise.index');
Route::get('/franchise/{slug}', [FranchiseController::class, 'show'])->name('franchise.show');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');

// ─── AUTH ROUTES ──────────────────────────────────────────────────────────────
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// ─── ADMIN ROUTES (Protected) ─────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Menu CRUD
    Route::get('/menus', [AdminMenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/create', [AdminMenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [AdminMenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{menu}/edit', [AdminMenuController::class, 'edit'])->name('menus.edit');
    Route::put('/menus/{menu}', [AdminMenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{menu}', [AdminMenuController::class, 'destroy'])->name('menus.destroy');

    // Franchise CRUD
    Route::get('/franchise', [AdminFranchiseController::class, 'index'])->name('franchise.index');
    Route::get('/franchise/create', [AdminFranchiseController::class, 'create'])->name('franchise.create');
    Route::post('/franchise', [AdminFranchiseController::class, 'store'])->name('franchise.store');
    Route::get('/franchise/{franchise}/edit', [AdminFranchiseController::class, 'edit'])->name('franchise.edit');
    Route::put('/franchise/{franchise}', [AdminFranchiseController::class, 'update'])->name('franchise.update');
    Route::delete('/franchise/{franchise}', [AdminFranchiseController::class, 'destroy'])->name('franchise.destroy');

    // Promotions CRUD
    Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
    Route::get('/promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('/promotions', [PromotionController::class, 'store'])->name('promotions.store');
    Route::get('/promotions/{promotion}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');
    Route::put('/promotions/{promotion}', [PromotionController::class, 'update'])->name('promotions.update');
    Route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.destroy');

    // Sales & Laporan
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
    Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');

    // AI Promo Assistant
    Route::get('/ai-promo-assistant', [AiAssistantController::class, 'index'])->name('ai-assistant.index');
    Route::post('/ai-promo-assistant/generate', [AiAssistantController::class, 'generate'])->name('ai-assistant.generate');
    Route::post('/ai-promo-assistant/upload-template', [AiAssistantController::class, 'uploadTemplate'])->name('ai-assistant.upload-template');
    Route::post('/ai-promo-assistant/publish', [AiAssistantController::class, 'publish'])->name('ai-assistant.publish');
});
