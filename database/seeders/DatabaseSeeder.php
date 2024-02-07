<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Book;
use \App\Models\Review;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // each() like lambda x:x....... in python
        Book::factory(33)->create()->each(function($book){
            $numReviews=random_int(5,30);

            Review::factory($numReviews)
                ->good() // we can just -> and add another some state methods but not calling any methods conflicts with another methods.
                ->for($book) // using the variable sent to the function and the for is associated the reviews created to the $book
                ->create(); // create the reviews for each one book
        });

        Book::factory(33)->create()->each(function($book){
            $numReviews=random_int(5,30);
            Review::factory()->count($numReviews)
                ->average()
                ->for($book)
                ->create();
        });
        Book::factory(34)->create()->each(function($book){
            $numReviews=random_int(5,30);
            Review::factory()->count($numReviews)
                ->bad()
                ->for($book)
                ->create();
        });
    }
}
