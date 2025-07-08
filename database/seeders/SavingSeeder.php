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
            'user_id' => 1, // Thêm dòng này, nhớ sửa ID đúng với user thật trong bảng users
            'amount' => 1000000,
            'note' => 'Tiết kiệm tháng 5',
        ]);

        Saving::create([
            'goal_id' => 1,
            'user_id' => 1, // Thêm dòng này
            'amount' => 1000000,
            'note' => 'Tiết kiệm thêm',
        ]);
    }
}
