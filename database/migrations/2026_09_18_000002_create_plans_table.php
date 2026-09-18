<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->decimal('monthly_price', 12, 2);
            $table->decimal('annual_price', 12, 2);
            $table->string('status', 30)->default('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
