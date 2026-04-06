<?php

use App\Http\Controllers\HeroController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

// auth only (not verified): email verification should not block CMS; users implement MustVerifyEmail but
// many installs never finish verification — blocking all POST/create actions.
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('hero/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('hero', [HeroController::class, 'update'])->name('hero.update');

    Route::get('about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutController::class, 'update'])->name('about.update');

    Route::resource('articles', ArticleController::class)->names('articles');
});
