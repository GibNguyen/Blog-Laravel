<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use DateTime;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;
use Illuminate\Support\Facades\DB;


class CreatePostTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       Post::factory(30)->create()->each(function ($post){
        $randomFields = Category::all()->random(rand(1,4))->pluck('id');
        $post->category()->attach($randomFields);
       });
    }
}
