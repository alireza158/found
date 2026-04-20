<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')->constrained('periods');
            $table->foreignId('member_id')->constrained('members');
            $table->foreignId('passbook_id')->nullable()->constrained('passbooks');
            $table->foreignId('plan_id')->constrained('contribution_plans');
            $table->integer('expected_amount');
            $table->integer('paid_amount')->default(0);
            $table->dateTime('paid_at')->nullable();
            $table->enum('status', ['unpaid','partial','paid'])->default('unpaid');
            $table->string('note', 500)->nullable();
            $table->timestamps();

            $table->unique(['period_id','member_id','plan_id']);
            $table->index(['period_id','status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};
