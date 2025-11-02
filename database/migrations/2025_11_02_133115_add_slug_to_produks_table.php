<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('nama');
        });

        // Generate slugs for existing records
        DB::statement('UPDATE produks SET slug = LOWER(REPLACE(REPLACE(REPLACE(nama, " ", "-"), "&", "and"), ".", "")) WHERE slug IS NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
