<?php

use App\Category;
use App\User;
use Faker\Generator as Faker;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersCount = count(User::all());

        //politica, cronaca, scienze
        $categories = [
            'nocategory',
            'politica', 
            'cronaca', 
            'scienze'
        ];

        foreach ($categories as $category) {
            $newCategory = new Category;
            $newCategory->name = $category;
            $newCategory->user_id = rand(1, $usersCount);
            $newCategory->save();
        }
    }
}
