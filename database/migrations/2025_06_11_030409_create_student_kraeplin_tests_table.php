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
        Schema::create('student_kreaplin_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_student');
            $table->foreignId('id_kraeplin_schedule');
            $table->dateTime('start');
            $table->dateTime('finish');
            $table->integer('right_count');
            $table->integer('false_count');
            $table->integer('duration');
            $table->enum('status', ['running', 'finished']);
            $table->timestamps();

            $table->unique(['id_student', 'id_kraeplin_schedule']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_kreaplin_tests');
    }
};
