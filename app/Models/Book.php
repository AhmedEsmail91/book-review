<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Query\Builder as QueryBuilder;


class Book extends Model
{
    use HasFactory;
    protected $fillable = [ 'title', 'author' ];
    public function reviews() {
        return $this->hasMany(Review::class);
    }
    /*
    the following method is equavilant to Book::where('title','like','%$title');
    but instead we built it inside the model which is callable and the $query argument is filled by laravel 
    which provids it to the function through Builder DataType 
    */
    public function scopeTitle(Builder $query,string $title):Builder|QueryBuilder {
        return $query->where('title','like','%'. $title. '%');
    }

    
    // The filter will be applied if both from_date and to_date are provided in
    private function dateRangeFilter(Builder $query, $from=null, $to=null) {
        if($from && !$to){
            $query->where('created_at','>=',$from);
        }
        elseif(!$from && $to){
            $query->where('created_at','<=',$to);
        }
        elseif ($from && $to){
            $query->whereBetween('created_at',[$from ,$to]);
        }
    
    }
    public function scopePopular(Builder $query,$from=null,$to=null):Builder|QueryBuilder {
        return $query->withCount([
            // in arrow functions we don't put use() function to access the data from the scope and its limitation is that it takes just 1 expretion
            'reviews'=>fn(Builder $q)=>$this->dateRangeFilter($query,$from,$to)
            ])
            ->orderBy('created_at','asc');
    }
    public function scopeHighestRated(Builder $query,$from=null,$to=null):Builder|QueryBuilder {
        return $query->withAvg([
            'reviews'=>fn(Builder $q)=>$this->dateRangeFilter($query,$from,$to)
            ],'rating')
        ->withCount('reviews')
        ->orderBy('reviews_avg_rating','desc');
    }
    // Adding real-life use case
    Public function scopeMinReviews(Builder $query,$minReviews):Builder|QueryBuilder{
        // return $query->whereCount('reviews')->having('reviews_count');
        return $query->having('reviews_count','>',$minReviews)->orderBy('reviews_count','asc');
    }
}
