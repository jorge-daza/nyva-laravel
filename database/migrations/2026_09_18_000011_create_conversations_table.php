<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('establishment_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string('customer_identifier', 255);
            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();
            $table->string('status', 30);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
