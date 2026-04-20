<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('passbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->nullable()->constrained('members');
            $table->string('title', 190);
            $table->enum('type', ['central','savings','loan','other'])->default('savings');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['type','is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('passbooks');
    }
};
