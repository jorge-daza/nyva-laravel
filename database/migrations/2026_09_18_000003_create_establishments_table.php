<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('name', 150);
            $table->string('type', 50);
            $table->text('description')->nullable();
            $table->string('address', 255);
            $table->string('phone', 30);
            $table->string('email');
            $table->string('status', 30)->default('active');
            $table->dateTime('registered_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('establishments');
    }
};
