<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryPhotoController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

// auth only (not verified): email verification should not block CMS; users implement MustVerifyEmail but
// many installs never finish verification — blocking all POST/create actions.
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('site-settings/edit', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
    Route::put('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');
    Route::resource('menu-items', MenuItemController::class)->except(['show']);
    Route::get('gallery-photos', [GalleryPhotoController::class, 'library'])->name('gallery-photos.library');
    Route::resource('pages', PageController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('galleries.photos', GalleryPhotoController::class)->except(['show']);
});
