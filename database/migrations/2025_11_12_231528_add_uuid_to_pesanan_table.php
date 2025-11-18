<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('pesanans', 'uuid')) {
            Schema::table('pesanans', function (Blueprint $table) {
                $table->uuid('uuid')->unique()->after('id_pesanan');
            });
        }
    }

    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
    }
};
