<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('frequently_asked_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('establishment_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('question');
            $table->text('answer');
            $table->string('status', 30)->default('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('frequently_asked_questions');
    }
};
