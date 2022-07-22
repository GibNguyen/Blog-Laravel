<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use Illuminate\Support\Str;
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Post::class;
    
    public function definition()
    {
        return [
            'author'=>'User',
            'title'=>$this->faker->name(),
            // 'slug'=>Str::slug('asdhashd'),
            'content'=>$this->faker->text,
            'image'=>'download (3).png',
        ];
    }
}
