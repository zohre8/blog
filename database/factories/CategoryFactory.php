<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\category>
 */
class CategoryFactory extends Factory
{
    protected $model=Category::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name=$this->faker->words(2,true);
        return [
            'name'=>$name,
            'slug'=> make_slug($name),
            'description' => $this->faker->sentence(),
            'parent_id' => null
        ];
    }
}
