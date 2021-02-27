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

Route::get('/panel/articles',[\App\Http\Controllers\Panel\ArticleController::class,'index'])->name('panel.article.index');
Route::get('/panel/articles/create',[\App\Http\Controllers\Panel\ArticleController::class,'create'])->name('panel.article.create');
Route::get('/panel/articles/edit/{article}',[\App\Http\Controllers\Panel\ArticleController::class,'edit'])->name('panel.article.edit');
Route::post('/panel/articles/update/{article}',[\App\Http\Controllers\Panel\ArticleController::class,'update'])->name('panel.article.update');
Route::post('/panel/articles/store',[\App\Http\Controllers\Panel\ArticleController::class,'store'])->name('panel.article.store');
Route::get('/panel/articles/delete/{article}',[\App\Http\Controllers\Panel\ArticleController::class,'delete'])->name('panel.article.delete');
