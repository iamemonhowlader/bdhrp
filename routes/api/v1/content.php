<?php

use App\Http\Controllers\Api\V1\ContentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('hero', [ContentController::class, 'hero']);
    Route::get('about', [ContentController::class, 'about']);
    Route::get('about-sections', [ContentController::class, 'aboutSections']);
    Route::get('about-sections/{slug}', [ContentController::class, 'aboutSection']);
    Route::get('bootstrap', [ContentController::class, 'bootstrap']);
    Route::get('articles', [ContentController::class, 'articles']);
    Route::get('articles/{slug}', [ContentController::class, 'article']);
    Route::get('categories', [ContentController::class, 'categories']);
    Route::get('tags', [ContentController::class, 'tags']);
    Route::get('pages', [ContentController::class, 'pages']);
    Route::get('pages/{slug}', [ContentController::class, 'page']);
    Route::get('navigation', [ContentController::class, 'navigation']);
    Route::get('galleries', [ContentController::class, 'galleries']);
    Route::get('galleries/{slug}', [ContentController::class, 'gallery']);
    Route::get('gallery-photos', [ContentController::class, 'galleryPhotos']);
    Route::get('districts', [ContentController::class, 'districts']);
    Route::get('districts/{slug}', [ContentController::class, 'district']);
    Route::get('topics', [ContentController::class, 'topics']);
    Route::get('topics/{slug}', [ContentController::class, 'topic']);
    Route::get('team-members', [\App\Http\Controllers\Api\V1\TeamMemberController::class, 'index']);
    Route::get('committees', [\App\Http\Controllers\Api\V1\CommitteeController::class, 'index']);
    Route::get('committees/{slug}', [\App\Http\Controllers\Api\V1\CommitteeController::class, 'show']);
});
