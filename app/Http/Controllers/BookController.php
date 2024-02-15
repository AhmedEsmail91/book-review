<?php

namespace App\Http\Controllers;
use \App\Models\Book;
use Illuminate\Http\Request;

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
        
        $books=$books->paginate();
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
        return view('books.show', ['book' => $book->load([
            'reviews'=>fn($q)=>$q->latest()
        ])]);
        // return view('books.show', ['book' => $book->load(
        //     ['reviews'=>fn($q)=>$q->orderByDesc('rating')]
        // )]);
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
