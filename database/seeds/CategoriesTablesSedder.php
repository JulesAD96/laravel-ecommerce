<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTablesSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            "name" => "High Tech",
            "slug" => "high-tech",
        ]);

        Category::create([
            "name" => "Books",
            "slug" => "books-store",
        ]);

        Category::create([
            "name" => "Food",
            "slug" => "food-store",
        ]);

        Category::create([
            "name" => "Life Style",
            "slug" => "life-style",
        ]);

        Category::create([
            "name" => "Divertisment",
            "slug" => "divertisment",
        ]);
    }
}
