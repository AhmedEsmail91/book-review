<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Review;
use App\Models\Book;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = date('Y-m-d H:i:s', $this->faker->dateTimeBetween('-7 years', 'now')->getTimestamp());
        return [
            'review' => $this->faker->paragraph,
            'rating' => $this->faker->numberBetween(1, 5),
            'book_id' => null,
            'created_at' => $createdAt,
            'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now')->format('Y-m-d H:i:s')
        ];
    }

    //Custom state method this methods change the values of attributes to specify some values {Override}
    public function good()
    {
        return $this->state(function (array $attributes) {
            return ['rating' => $this->faker->numberBetween(4, 5)];
        });
    }

    public function average()
    {
        return $this->state(function (array $attributes) {
            return ['rating' => $this->faker->numberBetween(2, 5)];
        });
    }

    public function bad()
    {
        return $this->state(function (array $attributes) {
            return ['rating' => $this->faker->numberBetween(1, 3)];
        });
    }
}
