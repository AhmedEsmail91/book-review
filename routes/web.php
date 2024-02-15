<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use \App\Models\Book;

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
Route::get('/',fn()=>redirect()->route('books.index'));
Route::resource('books',BookController::class);