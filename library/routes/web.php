<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use Illuminate\Foundation\Bootstrap\LoadConfiguration;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['web', 'auth'])->group(function(){
    Route::get('/', [BookController::class, 'dashboard']); 

    //MEMBERS
    Route::get('/members', [MemberController::class, 'index']); 
    Route::get('/members/create', [MemberController::class, 'create']); 
    Route::post('/members', [MemberController::class, 'store']);
    Route::get('/members/{id}/edit', [MemberController::class, 'edit']);
    Route::put('/members/{id}', [MemberController::class, 'update']);
    Route::delete('/members/{id}', [MemberController::class, 'destroy']);

    //BOOKS
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/create', [BookController::class, 'create']);
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books/{id}/edit', [BookController::class, 'edit']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);

    //LOANS
    Route::get('/loans', [LoanController::class, 'index']);
    Route::get('/loans/create3', [LoanController::class, 'create']);
    Route::post('/loans', [LoanController::class, 'store']);
    Route::get('/loans/{id}/edit', [LoanController::class, 'edit']);
    Route::put('/loans/{id}', [LoanController::class, 'update']);
    Route::delete('/loans/{id}', [LoanController::class, 'destroy']);

    Route::post('/loans/{id}/return', [LoanController::class, 'returnBook']); //update books table & loans table (book returned)
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
