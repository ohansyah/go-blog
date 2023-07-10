<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::upsert([
            [
                'name' => 'Web Development',
            ], [
                'name' => 'MVC',
            ], [
                'name' => 'Laravel 8.x',
            ], [
                'name' => 'Laravel 9.x',
            ], [
                'name' => 'Laravel 10.x',
            ], [
                'name' => 'Performance',
            ], [
                'name' => 'Full Stack Development',
            ], [
                'name' => 'Coding',
            ], [
                'name' => 'Programming',
            ], [
                'name' => 'Backend',
            ], [
                'name' => 'Frontend',
            ], [
                'name' => 'Fullstack',
            ],
        ], ['name']);
    }
}
