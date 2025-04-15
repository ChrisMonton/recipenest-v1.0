<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('recipes')->insert([
        //     [
        //         'user_id' => 1,
        //         'type' => 'food',
        //         'title' => 'Eat Healthy',
        //         'short_description' => 'hello world, goodbye world, oh I\'m confused because programming hurts',
        //         'full_description' => 'hello world, goodbye world, oh I\'m confused because programming hurts',
        //         'image' => 'images/media/default.jpg',
        //         'total_time' => 1,
        //         'time_in_unit' => 'minute',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => null,
        //     ],
        // ]);
    }
}
