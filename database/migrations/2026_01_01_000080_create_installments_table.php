<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained('loans')->cascadeOnDelete();
            $table->date('due_date');
            $table->integer('principal_part');
            $table->integer('fee_part');
            $table->integer('total_due');
            $table->integer('paid_amount')->default(0);
            $table->dateTime('paid_at')->nullable();
            $table->enum('status', ['unpaid','partial','paid'])->default('unpaid');
            $table->timestamps();

            $table->index(['due_date','status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('installments');
    }
};
