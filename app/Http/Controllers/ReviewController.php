<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        // after making the controller and making the dependencies of the relatio then the name of the route will be displayed in the route:list in the terminal
        return view('books.reviews.create',compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
{
    $validatedData = $request->validate([
        'review' => 'required|min:15',
        'rating' => 'required|integer|min:1|max:5',
    ], [
        'review.required' => 'Review Field is Required Mother Fucker',
        'review.min' => 'The review must be at least 15 characters long.',
        'rating.required' => 'Please Add Rating',
        'rating.integer' => 'The rating must be a whole number.',
        'rating.min' => 'The rating must be at least 1.',
        'rating.max' => 'The rating must be at most 5.',
    ]);

    $book->reviews()->create($validatedData);

    return redirect()->route('books.show', compact('book'))->with('review_added', 'A new Review added successfully');
}

    /*
    Note: we can cusmize the error(validation) message:
    public function store(Request $request, Book $book)
{
    $validatedData = $request->validate([
        'review' => 'required|min:15',
        'rating' => 'required|integer|min:1|max:5',
    ], [
        'review.required' => 'The review field is required.',
        'review.min' => 'The review must be at least 15 characters long.',
        'rating.required' => 'Please select a rating.',
        'rating.integer' => 'The rating must be a whole number.',
        'rating.min' => 'The rating must be at least 1.',
        'rating.max' => 'The rating must be at most 5.',
    ]);

    $book->reviews()->create($validatedData);

    return redirect()->route('books.show', compact('book'))->with('review_added', 'A new Review added successfully');
}

    */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
