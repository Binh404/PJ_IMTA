<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        Transaction::create([
            'user_id' => 1,
            'category_id' => 1, // Lương
            'type' => 'income',
            'amount' => 5000000,
            'date' => now()->subDays(5),
            'note' => 'Lương tháng 5',
        ]);

        Transaction::create([
            'user_id' => 1,
            'category_id' => 3, // Ăn uống
            'type' => 'expense',
            'amount' => 1500000,
            'date' => now()->subDays(3),
            'note' => 'Ăn uống cuối tuần',
        ]);
    }
}