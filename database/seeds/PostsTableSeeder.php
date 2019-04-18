<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        for($i = 0; $i < 50;$i++){
            Post::create([
                'title'=> \Faker\Factory::create()->sentence,
                'body'=> \Faker\Factory::create()->paragraph
            ]);
        }
    }
}
