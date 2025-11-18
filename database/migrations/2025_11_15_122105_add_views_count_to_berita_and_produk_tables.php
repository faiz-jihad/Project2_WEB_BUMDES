<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->unsignedBigInteger('views_count')->default(0)->after('status');
        });

        Schema::table('produks', function (Blueprint $table) {
            $table->unsignedBigInteger('views_count')->default(0)->after('stok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->dropColumn('views_count');
        });

        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('views_count');
        });
    }
};
