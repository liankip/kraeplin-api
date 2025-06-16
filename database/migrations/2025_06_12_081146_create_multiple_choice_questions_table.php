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
        Schema::create('multiple_choice_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_multiple_choice');
            $table->string('question', 100);
            $table->string('option_a', 100);
            $table->string('option_b', 100);
            $table->string('option_c', 100);
            $table->string('option_d', 100);
            $table->string('option_e', 100);
            $table->string('answer', 10);
            $table->integer('score');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('multiple_choice_questions');
    }
};
