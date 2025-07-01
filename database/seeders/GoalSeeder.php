<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Goal;

class GoalSeeder extends Seeder
{
    public function run()
    {
        Goal::create([
            'user_id' => 1,
            'name' => 'Tiết kiệm mua xe',
            'amount' => 6000000,
            'current_amount' => 2000000,
            'start_date' => '2025-05-01',
            'end_date' => '2025-07-31',
            'status' => 'ongoing',
        ]);
    }
}