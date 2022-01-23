<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(rand(1,3)),
            'category_id' => Category::all()->shuffle()->first(),
            'price' => $this->faker->randomFloat(2,9,rand(999,999999)),
            'amount' => $this->faker->randomNumber(rand(1,3),false),
            'description' => $this->faker->text(rand(15,130))
        ];
    }
}
