<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUlid('user_id');
            $table->unsignedBigInteger('amount');
            $table->tinyInteger('type');
            $table->tinyInteger('direction');
            $table->string('description');
            $table->foreignId('obligation_id')->nullable();
            $table->timestamp('executed_at');

            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
