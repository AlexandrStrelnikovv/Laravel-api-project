<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

require __DIR__.'/auth.php';

Route::prefix('articles')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/', [ArticleController::class, 'store']);
        Route::put('/{id}', [ArticleController::class, 'update']);
        Route::post('{article}/like', [ArticleController::class, 'like']);
        Route::post('{article}/unlike', [ArticleController::class, 'unlike']);
    });
    Route::get('/', [ArticleController::class, 'index']);
    Route::get('/{id}', [ArticleController::class, 'show']);
});
