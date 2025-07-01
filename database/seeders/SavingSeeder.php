<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Saving;

class SavingSeeder extends Seeder
{
    public function run()
    {
        Saving::create([
            'goal_id' => 1,
            'amount' => 1000000,
            'date' => now()->subDays(10),
            'note' => 'Tiết kiệm tháng 5',
        ]);

        Saving::create([
            'goal_id' => 1,
            'amount' => 1000000,
            'date' => now()->subDays(2),
            'note' => 'Tiết kiệm thêm',
        ]);
    }
}