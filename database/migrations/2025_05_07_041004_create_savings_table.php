<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/2025_05_07_000005_create_savings_table.php
return new class extends Migration {
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Gán user_id từ bảng users
            $table->foreignId('goal_id')->constrained()->onDelete('cascade');  // Liên kết với bảng goals
            $table->decimal('amount', 15, 2);  // Số tiền tiết kiệm
            $table->string('note')->nullable();  // Ghi chú
            $table->timestamps();  // Tạo các trường created_at, updated_at
        });

    }

    public function down()
    {
        Schema::dropIfExists('savings');
    }
};
