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
        Schema::create('obligations', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('expected_amount');
            $table->tinyInteger('type');
            $table->tinyInteger('status');
            $table->string('description');
            $table->date('due_date');
            $table->foreignId('user_id');
            $table->foreignId('account_id');
            $table->foreignId('commitment_id')->nullable();

            $table->timestamps();

            $table->unique(['commitment_id', 'due_date']); // Para evitar que crie mais de uma cobrança específica para a mesma data
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obligations');
    }
};
