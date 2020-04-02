<?php

use App\Article;
use App\User;
use App\Argument;
use App\Category;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i=0; $i < 10; $i++) {
            $newArticle = new Article;
            $newArticle->user_id = User::inRandomOrder()->first()->id;
            $newArticle->category_id = Category::inRandomOrder()->first()->id;
            $newArticle->title = $faker->sentence(6);
            $newArticle->body = $faker->paragraph(10);
            $newArticle->summary = Str::limit($newArticle->body, 20);
            $newArticle->slug = Str::slug($newArticle->title) . '-' . Carbon::now()->isoFormat('Y-M-D');
            $newArticle->published = rand(0, 1);
            $newArticle->save();
        }
       
    }
}
