<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('draws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('period_id')->constrained('periods');
            $table->date('draw_date');
            $table->enum('method', ['random','manual'])->default('random');
            $table->json('rules_json')->nullable();
            $table->foreignId('winner_member_id')->nullable()->constrained('members');
            $table->unsignedBigInteger('loan_id')->nullable();
            $table->enum('status', ['planned','done','canceled'])->default('planned');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('draws');
    }
};
