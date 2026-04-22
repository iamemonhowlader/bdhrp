<?php

use App\Http\Controllers\HeroController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

// auth only (not verified): email verification should not block CMS; users implement MustVerifyEmail but
// many installs never finish verification — blocking all POST/create actions.
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('hero/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('hero', [HeroController::class, 'update'])->name('hero.update');

    Route::get('about/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('about', [AboutController::class, 'update'])->name('about.update');

    Route::resource('about-sections', \App\Http\Controllers\AboutSectionController::class)->names('about-sections');
    Route::resource('articles', ArticleController::class)->names('articles');
    Route::resource('articles_videos', VideoController::class)->names('articles_videos');
    Route::resource('districts', DistrictController::class)->names('districts');
    Route::resource('topics', TopicController::class)->names('topics');
    Route::resource('team-members', \App\Http\Controllers\TeamMemberController::class)->names('team-members');
});
