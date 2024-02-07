<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = date('Y-m-d H:i:s', $this->faker->dateTimeBetween('-10 years', 'now')->getTimestamp());
        return [
            "title" => $this->faker->sentence(3),
            'author' => $this->faker->name,
            'created_at' => $createdAt,
            'updated_at' => $this->faker->dateTimeBetween($createdAt, 'now')->format('Y-m-d H:i:s')
        ];
    }
}
