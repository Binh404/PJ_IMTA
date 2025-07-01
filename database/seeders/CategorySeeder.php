<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Lương', 'type' => 'income'],
            ['name' => 'Thưởng', 'type' => 'income'],
            ['name' => 'Ăn uống', 'type' => 'expense'],
            ['name' => 'Giải trí', 'type' => 'expense'],
            ['name' => 'Đi lại', 'type' => 'expense'],
            ['name' => 'Tiết kiệm', 'type' => 'income'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}