<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'index'])->name('dashboard');
Route::get('/books/search', [BookController::class, 'getBookByName'])->name('books.search');
Route::get('/books/genre/{genre_name}', [BookController::class, 'genreBook'])->name('books.byGenre');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

// autentikasi route
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register.store');
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.store');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/users/loans/{id}', [LoanController::class, 'userLoans'])->name('users.loans');
Route::get('/users/change-password/{id}', [UserController::class, 'changePassword'])->name('users.change.password');
Route::put('/users/change-password/{id}', [UserController::class, 'changePassword'])->name('users.update.password');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');


Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/books', [AdminController::class, 'books'])->name('admin.books');
    Route::get('/admin/books/create', [BookController::class, 'create'])->name('admin.books.create');
    Route::post('/admin/books/store', [BookController::class, 'bookStore'])->name('admin.books.store');
    Route::get('/admin/books/{id}', [BookController::class, 'bookEdit'])->name('admin.books.edit');
    Route::put('/admin/books/{id}', [BookController::class, 'bookUpdate'])->name('admin.books.update');
    Route::delete('/admin/books/{id}', [BookController::class, 'bookDestroy'])->name('books.destroy');
    Route::get('/admin/create-admin', [AdminController::class, 'createNewAdmin'])->name('admin.add.admin');
    Route::post('/admin/store-admin', [AdminController::class, 'storeNewAdmin'])->name('admin.store.admin');
    Route::get('/admin/genres', [AdminController::class, 'genres'])->name('admin.genres');
    Route::get('/admin/genres/create', [GenreController::class, 'create'])->name('admin.genres.create');
    Route::post('/admin/genre/store', [GenreController::class, 'store'])->name('admin.genres.store');
    Route::get('/admin/genres/{id}', [GenreController::class, 'edit'])->name('admin.genres.edit');
    Route::put('/admin/genres/{id}', [GenreController::class, 'update'])->name('admin.genres.update');
    Route::delete('/admin/genres/{id}', [GenreController::class, 'destroy'])->name('admin.genres.destroy');
});

Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
Route::put('/loans/{id}', [LoanController::class, 'return'])->name('loans.return');
Route::get('/admin/loans', [LoanController::class, 'index'])->name('admin.loans');
Route::get('/admin/loans/{id}', [LoanController::class, 'show'])->name('admin.loans.show');
Route::get('/admin/loans/{id}/edit', [LoanController::class, 'edit'])->name('admin.loans.edit');
Route::put('/admin/loans/{id}', [LoanController::class, 'update'])->name('admin.loans.update');
Route::delete('/admin/loans/{id}', [LoanController::class, 'destroy'])->name('admin.loans.destroy');