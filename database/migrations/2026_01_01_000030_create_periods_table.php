<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->integer('month');
            $table->date('starts_at');
            $table->date('ends_at');
            $table->enum('status', ['open','closed'])->default('open');
            $table->timestamps();

            $table->unique(['year','month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periods');
    }
};
