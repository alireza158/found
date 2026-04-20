<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members');
            $table->foreignId('passbook_id')->constrained('passbooks'); // central
            $table->integer('principal_amount');
            $table->integer('fee_amount')->default(0);
            $table->integer('total_amount');
            $table->integer('installments_count');
            $table->date('start_date');
            $table->enum('status', ['active','settled','canceled'])->default('active');
            $table->unsignedBigInteger('draw_id')->nullable();
            $table->string('note', 500)->nullable();
            $table->timestamps();

            $table->index(['member_id','status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
