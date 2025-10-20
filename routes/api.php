<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::prefix('articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{id}', [ArticleController::class, 'show']);
    Route::post('/', [ArticleController::class, 'store']);
    Route::put('/{id}', [ArticleController::class, 'update']);
    Route::post('{article}/like', [ArticleController::class, 'like']);
    Route::post('{article}/unlike', [ArticleController::class, 'unlike']);
});
