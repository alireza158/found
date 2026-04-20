<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')->nullable()->constrained('periods');
            $table->integer('amount');
            $table->dateTime('occurred_at');
            $table->string('category', 120);
            $table->string('description', 500)->nullable();
            $table->string('attachment_path', 250)->nullable();
            $table->timestamps();

            $table->index(['occurred_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
