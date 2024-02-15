<?php

namespace App\Http\Controllers;
use \App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Review;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title=$request->input('title');
        $filter=$request->input('filter');

        $books=Book::when($title,fn($query,$title)=>$query->title($title));
        // switch function like match
        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6months' => $books->popularLast6Months(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6months' => $books->highestRatedLast6Months(),
            default => $books->latest()->withAvgRating()->withReviewsCount()
        };
        
        /*----------------------------------------------Cacheing----------------------------------------------*/
        // With cache we need some kind of key to store data in it  so we can get it later if needed
        // remember('key',reservation_time,function_to_return_data).
        // and then replace the retrieved pagination result with it:
        // $books=$books->paginate();
        /* $books=Cache::remember('books',3600,fn()=> $books->paginate()); */
        // or instead of using static function simply make an object and callback the method:
        /* $books=cache()->remember('books',3600,fn()=> $books->paginate()); */
        ////////////////////////////////////////////////////////////////////////////////////////
        // the cache key must be unique cause in case of using filtering or searching from any user the result will be showen for other users too
        // so in that case we gonna make a cacheKey for each situation.
        //chaching name using md5 encryption more secured: 
        // $cacheKey=md5("books?title={$title}&filter={$filter}");
        // simple  caching without any condition :
        $cacheKey="books:$filter:$title";
        // $books=cache()->remember($cacheKey, 3600, fn()=>$books->get());
        $books=cache()->remember($cacheKey, 3600, function()use($books){
            dd('not cached');
            return $books->get();
        });
        
        return view('books.index',['books'=>$books,'filtora'=>$filter]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book=$book
        ->load([
            'reviews'=>fn($q)=>$q->orderByDesc('rating')
        ]);
        $book->avg_rating = $book->reviews->avg('rating');
        return view('books.show', compact('book'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
