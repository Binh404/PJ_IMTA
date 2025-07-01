<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Budget;

class BudgetSeeder extends Seeder
{
    public function run()
    {
        Budget::create([
            'user_id' => 1,
            'category_id' => 3, // Ăn uống
            'amount' => 2000000,
            'period' => 'monthly',
        ]);

        Budget::create([
            'user_id' => 1,
            'category_id' => 4, // Giải trí
            'amount' => 1000000,
            'period' => 'monthly',
        ]);
    }
}