<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\EnsureUserIsAdmin;
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

Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'user']);

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::prefix('articles')->group(function () {
    Route::get('/', [ArticleController::class, 'index']);
    Route::post('/', [ArticleController::class, 'store']);
    Route::get('{slug}', [ArticleController::class, 'show']);
    Route::put('{slug}', [ArticleController::class, 'update']);
    Route::delete('{slug}', [ArticleController::class, 'destroy']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('{slug}', [CategoryController::class, 'show']);
    Route::get('{slug}/articles', [CategoryController::class, 'articles']);
    Route::group(['middleware' => EnsureUserIsAdmin::class], function () {
        Route::post('/', [CategoryController::class, 'store']);
        Route::put('{slug}', [CategoryController::class, 'update']);
        Route::delete('{slug}', [CategoryController::class, 'destroy']);
    });
});

Route::prefix('authors')->group(function () {
    Route::get('/', [AuthorController::class, 'index']);
});
