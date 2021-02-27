<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [\App\Http\Controllers\API\LoginController::class, 'login'])->name('api.login');
Route::get('articles', [\App\Http\Controllers\API\ArticleController::class, 'index'])->name('api.article.index');
Route::post('articles', [\App\Http\Controllers\API\ArticleController::class, 'store'])->name('api.article.store');
Route::put('articles/{id}', [\App\Http\Controllers\API\ArticleController::class, 'update'])->name('api.article.update');
Route::delete('articles/{id}', [\App\Http\Controllers\API\ArticleController::class, 'delete'])->name('api.article.delete');
Route::delete('articles/unpublish/{id}', [\App\Http\Controllers\API\ArticleController::class, 'unpublish'])->name('api.article.unpublish');
