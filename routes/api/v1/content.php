<?php

use App\Http\Controllers\Api\V1\ContentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
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
});
