<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Array of tag titles
        $tags = [
            'Romance', 'Love', 'Fiction', 'Non-Fiction', 'Fantasy', 'Random',
        ];

        // Insert each title into the tags table
        foreach ($tags as $tag) {
            Tag::create([
                'tag' => $tag,
            ]);
        }

    }
}
