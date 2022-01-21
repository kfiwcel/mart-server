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
            'name'=>$this->faker->name,//
            'slug'=>$this->faker->unique()->slug(),
            'description'=>$this->faker->sentence,
            'price'=>$this->faker->randomDigit,
            'poster'=>$this->faker->imageUrl(),

            'category_id'=>Category::all()->random(1)->first()->id,
            'brand'=>$this->faker->randomElement([
                '小米',
                '华为',
                '苹果',
                'nike',
                'lenovo'
            ])
        ];
    }
}
