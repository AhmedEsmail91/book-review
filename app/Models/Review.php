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
    public static function  goodReview(Builder $query):Builder | QueryBuilder{
        return $query ->where('rating','>=',4); 
    }
    public static function avgReview(Builder $query):Builder | QueryBuilder{
        return $query ->whereBetween('rating',[2,5]);
        
    }
    public static function badReview(Builder $query):Builder |QueryBuilder{
        return $query ->whereBetween('rating',[1,3]);
    }
}
