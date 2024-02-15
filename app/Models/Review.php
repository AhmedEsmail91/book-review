<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Query\Builder as QueryBuilder;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['review', 'rating'];
    public function book() {
        // while the parent is the book class so the childs belongs to him  
        
        return $this->belongsTo(Book::class);
        
    }
    // to load only the reviews on the book with the following scopes which are good, avg, bad reviews on that book only
    public static function  scopeGoodReview(Builder $query):Builder | QueryBuilder{
        return $query ->where('rating','>=',4); 
    }
    public static function scopeAvgReview(Builder $query):Builder | QueryBuilder{
        return $query ->whereBetween('rating',[2,5]);
        
    }
    public static function scopeBadReview(Builder $query):Builder |QueryBuilder{
        return $query ->whereBetween('rating',[1,3]);
    }
    public static function scopeAverageIndividualBook(Builder $query):Builder | QueryBuilder{
        return $query->selectRaw('avg(rating) as average_rating')
        ->groupBy('book_id');
    }
    // In the BookController we just cached the reviews not the books 
    //so in this case we gonna make some magic to the Review Model to be interactive with the modifications(update, deleting,..) Model
    protected static function booted(){
        // in the forget you have to  put the cache key that was used when caching it.
        // so in book caching fortunately we used the book$book->id to be unique
        // there're alot of Events that can happen so you can find some events can be found there:
        //https://laravel.com/docs/10.x/eloquent#events
        // the following event is incase of updating the review and need to update the cache for this specific review-observers
        // Note: some examples this  method may not work if your app uses a lot of queries or has many users, or making the modification using sql server or using Raw SQL Query (where, Rawselect, etc..),
        //  in case of make transaction and then rolled back in the previous cases this handler won't be triggered
        // The Modifications must be done using the model inside laravel
        // you can check that before making updating page using tinker by making an instance of it an then make a modification and then $review->save();
        static::updated(fn(Review $review)=>cache()->forget('book:'.$review->book->id /* or simply  $review->book_id but the previous is more generalized */));
        static::deleted(fn(Review $review)=>cache()->forget('book:'.$review->book->id));
        
    }
}
