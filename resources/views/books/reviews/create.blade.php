@extends('layouts.app')
@section('content')
    <h1 class="mb-10 text-2xl">Add Review for <span class="font-bold underline">{{$book->title}}</span></h1>
    <form action="{{route('books.reviews.store',['book'=>$book])}}" method="post">
    @csrf
    <label for="review">Review</label>
    <textarea name="review" id="review" required class=" input resize-none"></textarea>
    <select name="rating" id="rating" class="input mb-4">
        <option value="">Select a Rating</option>
        @for ($i = 1; $i <= 5; $i++)
            <option value="{{$i}}"><x-star-rating :rating="$i"/></option>
        @endfor
    </select>
    <button type="submit" class="btn">Add Review</button>
    </form>
@endsection