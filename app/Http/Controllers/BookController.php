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
        // $books=Book::when($title,function($query,$title){
        //     return $query->title($title);
        // })->paginate(20);
        // or simply use arrow function:
        $books=Book::when($title,fn($query,$title)=>$query->title($title))->get();

        return view('books.index',['books'=>$books]);
        // or simply use the compact('var_name') this compact function which will find a variable with the name 
        // var_name and turn it into an array with the key (var_name) and the value of the variable with the same name:
        // return view('books.index',compact('books'));
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
