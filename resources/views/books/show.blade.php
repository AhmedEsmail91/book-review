@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h1 class="sticky top-0 mb-2 text-2xl">{{ $book->title }}</h1>
    <div class="book-info">
    <div class="book-author mb-4 text-lg font-semibold">by {{ $book->author }}</div>
    <div class="book-rating flex items-center">
        <div class="book-rating mr-1">
            {{number_format($book->avg_rating,1)}}
        </div>

        {{-- to Add a compnent for the rating x-fname-secondname-etc... --}}
        <x-star-rating :rating="$book->avg_rating"/>
        
        <span class=" book-review-count text-sm text-gray-500">
        {{ $book->reviews->count() }} {{ Str::plural('review', 5) }}
        </span>
    </div>
    </div>
</div>
<div class="mb-4">
    <a class="reset-link" href="{{route('books.reviews.create',['book'=>$book])}}">Add a review !</a>
</div>
<div>
    <h2 class="mb-4 text-xl font-semibold">Reviews</h2>
    <ul>
    @forelse ($book->reviews as $review)
        <li class="book-item mb-4">
        <div>
            <div class="mb-2 flex items-center justify-between">
            <div class="font-semibold"><x-star-rating :rating="$review->rating"/></div>
            <div class="book-review-count">
                {{ $review->created_at->format('M j, Y') }}</div>
            </div>
            <p class="text-gray-700">{{ $review->review }}</p>
        </div>
        </li>
    @empty
        <li class="mb-4">
        <div class="empty-book-item">
            <p class="empty-text text-lg font-semibold">No reviews yet</p>
        </div>
        </li>
    @endforelse
    </ul>
</div>
@endsection

