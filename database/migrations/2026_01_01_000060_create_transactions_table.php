<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passbook_id')->constrained('passbooks');
            $table->foreignId('member_id')->nullable()->constrained('members');
            $table->foreignId('period_id')->nullable()->constrained('periods');

            $table->enum('type', ['contribution','loan_disbursement','installment_payment','expense','adjustment']);
            $table->enum('direction', ['in','out']);
            $table->integer('amount');

            $table->string('ref_type')->nullable();
            $table->unsignedBigInteger('ref_id')->nullable();

            $table->dateTime('occurred_at');
            $table->string('description', 250)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();

            $table->index(['passbook_id','direction']);
            $table->index(['ref_type','ref_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
