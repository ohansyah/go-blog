<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::upsert([
            [
                'id' => 1,
                'parent_id' => null,
                'name' => 'PHP',
                'image' => 'category/php.png',
            ], [
                'id' => 2,
                'parent_id' => null,
                'name' => 'Laravel',
                'image' => 'category/laravel.png',
            ], [
                'id' => 3,
                'parent_id' => null,
                'name' => 'News',
                'image' => 'category/news.png',
            ], [
                'id' => 4,
                'parent_id' => 2,
                'name' => 'Tips',
                'image' => 'category/tips.png',
            ], [
                'id' => 5,
                'parent_id' => 2,
                'name' => 'Performance',
                'image' => 'category/performance.png',
            ],
        ], ['id', 'parent_id', 'name', 'image']);
    }
}
