@extends('layouts.app')
@section('content')
    <h1 class="mb-10 text-2xl">Add Review for <span class="font-bold underline">{{$book->title}}</span></h1>
    <form action="{{route('books.reviews.store',['book'=>$book])}}" method="post">
    @csrf
    
    <label for="review">Review</label>
    <textarea name="review" id="review"  class=" input resize-none">{{old('review')}}</textarea>
    @error('review')
        <p class="error mb-2">{{$message}}</p>
    @enderror
    <select name="rating" id="rating" class="input mb-4" value="{{old("rating")}}">
        <option value="">Select a Rating</option>
        @for ($i = 1; $i <= 5; $i++)
        <option name="opt{{$i}}" value="{{$i}}" {{ old('rating') == $i ? 'selected' : '' }}>
            <x-star-rating :rating="$i"/></option>
            
        @endfor
    </select>
    @error('rating')
        <p class="error mb-2">{{$message}}</p>
    @enderror
    <button type="submit" class="btn">Add Review</button>
    </form>
@endsection
