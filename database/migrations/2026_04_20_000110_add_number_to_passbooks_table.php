<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('passbooks', function (Blueprint $table) {
            $table->string('number', 60)->nullable()->after('member_id');
            $table->index('number');
        });
    }

    public function down(): void
    {
        Schema::table('passbooks', function (Blueprint $table) {
            $table->dropIndex(['number']);
            $table->dropColumn('number');
        });
    }
};
