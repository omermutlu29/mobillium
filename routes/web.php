<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\Web\ArticleController::class,'index'])->name('web.article.index');
Route::get('/article/{article}', [\App\Http\Controllers\Web\ArticleController::class,'show'])->name('web.article.show');
Route::post('/article/rate/{article}', [\App\Http\Controllers\Web\ArticleController::class,'rate'])->name('web.article.rate');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
