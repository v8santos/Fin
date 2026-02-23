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
        Schema::create('commitments', function (Blueprint $table) {
            $table->id();

            $table->foreignUlid('user_id');
            $table->bigInteger('fixed_amount')->nullable();
            $table->boolean('is_variable');
            $table->string('description');
            $table->boolean('is_active');
            $table->text('rrule');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('last_generated_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commitments');
    }
};
