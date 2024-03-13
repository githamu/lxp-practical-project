<?php

namespace Database\Factories;

use App\Shop\Products\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewModelFactory extends Factory
{
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 10),
            'customer_id' => $this->faker->numberBetween(1, 6),
            'evaluation' => $this->faker->numberBetween(1, 5),
            'review' => $this->faker->text(100)
        ];
    }
}