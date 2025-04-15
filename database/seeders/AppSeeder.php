<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Tag;
use App\Models\User;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Create x users
        $users = User::factory(6)->create();
        $user_data = User::all();



        // Create x recipes for authors
        foreach ($user_data as $chef) {
            $number = rand(1, 5);
            $chef->recipes()->createMany(
                Recipe::factory($number)->make()->toArray()
            );
        }


        // Get all recipes
        $recipe_data = Recipe::all();
        // $recipe_data = Recipe::inRandomOrder()->limit(5)->get();


        // Get array or ids
        $user_ids = User::pluck('id')->toArray();



        // For each writing, post random reviews by random users
        $recipe_data->each(function ($recipe) use ($user_ids) {
            Review::factory()
            ->count(random_int(1, 5))
            ->randomUsers($user_ids)
            ->create([
                // 'user_id' => $recipe->user_id,
                'recipe_id' => $recipe->id,
            ]);
        });


        // Add 10 recipes for user 1
        $user = User::findOrFail(1);
        // Create 10 recipes
        $number = 6;
        $user->recipes()->createMany(
            Recipe::factory($number)->featured()->make()->toArray()
        );
        // Add 6 featured
    }
}
