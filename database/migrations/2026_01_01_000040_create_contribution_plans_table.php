<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contribution_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title', 190);
            $table->integer('amount');
            $table->foreignId('start_period_id')->nullable()->constrained('periods');
            $table->foreignId('end_period_id')->nullable()->constrained('periods');
            $table->enum('late_fee_type', ['none','fixed','percent'])->default('none');
            $table->integer('late_fee_value')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contribution_plans');
    }
};
