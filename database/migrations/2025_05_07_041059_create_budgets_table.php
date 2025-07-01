<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// database/migrations/2025_05_07_000006_create_budgets_table.php
return new class extends Migration {
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable();
            $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onDelete('set null');
            $table->decimal('amount', 12, 2);
            $table->enum('period', ['monthly', 'yearly'])->default('monthly');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('budgets');
    }
};