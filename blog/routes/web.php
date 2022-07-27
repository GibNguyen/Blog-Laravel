<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashBoardController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\user\HomePageController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('', [HomePageController::class, 'index'])->name('index');
Route::get('/detail/{id}', [HomePageController::class, 'detail'])->name('detail');
Route::post('/detail/{id}', [HomePageController::class, 'comment']);
Route::get('/search', [HomePageController::class, 'search'])->name('search');
Route::get('/category/{id}',[HomePageController::class, 'category'])->name('category');
Route::get('/logout',[HomePageController::class, 'logout'])->name('logout');
Route::get('/jquery',[HomePageController::class, 'jquery'])->name('jquery');
Route::get('/comment/delete/{id}', [HomePageController::class, 'deleteComment'])->name('deleteComment');



Route::prefix('admin')->middleware('auth','can:permissions')->name('admin.')->group(function () {
    Route::get('/', [DashBoardController::class, 'index'])->name('index');

    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/add', [PostController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('edit');
        Route::get('/delete/{id}', [PostController::class, 'delete'])->name('delete');
        Route::post('/add', [PostController::class, 'postAdd']);
        Route::post('/edit/{id}', [PostController::class, 'postEdit']);
        Route::get('/detail/{id}', [PostController::class, 'detail'])->name('detail');
    });
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/add', [CategoryController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
        Route::post('/add', [CategoryController::class, 'postAdd']);
        Route::post('/edit/{id}', [CategoryController::class, 'postEdit']);
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/add', [UserController::class, 'add'])->name('add');
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
        Route::post('/add', [UserController::class, 'postAdd']);
        Route::post('/edit/{id}', [UserController::class, 'postEdit']);
    });
});
