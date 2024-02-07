<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['review', 'rating'];
    public function book() {
        // while the parent is the book class so the childs belongs to him  
        
        return $this->belongsTo(Book::class);
        
    }
}
