<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/home', [AdminPanelController::class, 'index']);
Route::get('/', [HomeController::class, 'home1'])->name('home1');
Route::get('/home1', [HomeController::class, 'home1']);

Route::get('/adminPanel', [AdminPanelController::class, 'index'])->name('admin.panel');

//Route::get('/', function () {return view('home');});
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//categories
Route::get('/categories', [CategoryController::class, 'create']);
Route::get('/adminPanel', [AdminPanelController::class, 'admin']);
Route::get('/categories', [AdminPanelController::class, 'list_categories']);
Route::post('/categories', [AdminPanelController::class, 'save_categories']);
Route::get('/categories/search', [AdminPanelController::class, 'search_categories']);
Route::get('/categories/{id}/edit', [AdminPanelController::class, 'edit_category']);
Route::put('/categories/{id}', [AdminPanelController::class, 'update_category']);
Route::delete('/categories/{id}', [AdminPanelController::class, 'delete_category']);

//posts
/// Show the post creation form
Route::get('/adminPanel', [PostController::class, 'create'])->name('admin.panel');

// Handle the form submission
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Get posts list (alternative listing page)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Edit posts routes
Route::get('/edit_posts', [PostController::class, 'listPosts'])->name('posts.list');
Route::get('/edit_posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/edit_posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/edit_posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
