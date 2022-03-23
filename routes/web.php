<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
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
Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');

Route::get('blog', [BlogController::class, 'index']);
Route::get('blog/edit/{id}', [BlogController::class, 'blogById']);
Route::post('update-blog', [BlogController::class, 'updateBlog']);
Route::get('blog/delete/{id}', [BlogController::class, 'deleteBlog']);
Route::get('add-blog', [BlogController::class, 'add']);
Route::post('add-blog', [BlogController::class, 'store']);
Route::get('blog/{slug}', [BlogController::class, 'blogBySlug']);

Route::get('article', [ArticleController::class, 'index']);
Route::post('article', [ArticleController::class, 'store']);