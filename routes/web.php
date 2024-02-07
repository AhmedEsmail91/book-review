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
Route::get('/', function () {
    $num=12;
    $from=date('Y-m-d', strtotime("-$num years"));
    $to=date("Y-m-d", strtotime("-5 years"));
    $books = Book::HighestRated($from,$to)->minReviews(20)->paginate(22);
    return view('welcome', ['data' => $books]);
});
// Route::get('/', function () {
//     $minReviewsNumber=10;
//     $books=Book::minReviews($minReviewsNumber)->paginate(20);
//     // $min_reviews
//     return view('welcome',['data'=>$books]);
// });

Route::resource('book',BookController::class);
