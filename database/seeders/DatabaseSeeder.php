<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Article::factory(6)->create();

        $categories = ['News', 'Science', 'Tech', 'Movies', 'Music'];
        foreach ($categories as $category) {
            Category::factory()->create([
                'name' => $category
            ]);
        }

        Comment::factory(10)->create();

        User::factory()->create([
            'name' => 'Alice',
            'email' => 'alice@mail.com'
        ]);

        User::factory()->create([
            'name' => 'Bob',
            'email' => 'bob@mail.com'
        ]);
    }
}
