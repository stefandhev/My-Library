<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'index'])->name('dashboard');

Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.store');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.store');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

Route::get('/books/search', [BookController::class, 'getBookByName'])->name('books.search');