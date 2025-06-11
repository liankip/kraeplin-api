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
        Schema::create('kraeplin_schedule_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_group');
            $table->foreignId('id_kraeplin_schedule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kraeplin_schedule_groups');
    }
};
