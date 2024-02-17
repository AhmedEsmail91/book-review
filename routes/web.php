<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
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
Route::get('/', function () {
    return redirect()->route('books.index');
});

// we restricting specific methods that will be shown to avoid conflicts (optional)
// just specify which methods i use and others will be disabled evenif Implemented
Route::resource('books',BookController::class)
    // ->only(['index','show'])
    ;
// Here we use a different controller method, so we need to specify it explicitly
// Scoping
// review is a scope of a book
Route::resource('books.reviews', ReviewController::class)
    ->scoped(['review'=>'book']) // defining a relation between books and their reviews in the routing configuration of a web application
    /*The line ->scoped(['review'=>'book']) indicates that the reviews are scoped within the context of a book. This means that when performing actions related to reviews, such as creating or storing them, the system knows that these actions are specific to a particular book. */
    
    // ->only(['create','store','destroy']) 
    ;