<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{

    protected $model=Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence;
        return [
            'title'=>$title,
            'slug'=>make_slug($title),
            'description'=>$this->faker->text(200),
            'meta_title' => $this->faker->optional()->sentence,
            'meta_description' => $this->faker->optional()->paragraph,
            'user_id'=>User::factory(),
            'photo_id'=>Photo::factory(),
            'category_id'=>Category::factory(),
            'is_published'=>false,
        ];
    }
    public function published()
    {
        return $this->state(fn(array $attributes) => [
            'is_published' => true,
        ]);
    }
}
