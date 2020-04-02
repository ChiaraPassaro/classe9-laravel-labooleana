<?php

use App\Argument;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ArgumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();
        $usersCount = $users->count();

        for ($i=0; $i < 8; $i++) { 
            $argument = new Argument;
            $argument->name = $faker->word;
            $argument->user_id = rand(1, $usersCount);
            $argument->save();
        }
    }
}
