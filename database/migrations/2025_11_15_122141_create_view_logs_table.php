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
        Schema::create('view_logs', function (Blueprint $table) {
            $table->id();
            $table->string('entity_type'); // App\Models\Berita or App\Models\Produk
            $table->unsignedBigInteger('entity_id'); // ID of the entity
            $table->unsignedBigInteger('user_id')->nullable(); // User who viewed (null for guests)
            $table->string('session_id'); // Session identifier
            $table->string('ip_address'); // IP address
            $table->text('user_agent')->nullable(); // Browser user agent
            $table->string('fingerprint')->nullable(); // Unique fingerprint for anti-spam
            $table->timestamp('viewed_at'); // When the view occurred
            $table->timestamps();

            // Indexes for performance
            $table->index(['entity_type', 'entity_id']);
            $table->index(['user_id']);
            $table->index(['session_id']);
            $table->index(['ip_address']);
            $table->index(['fingerprint']);
            $table->index(['viewed_at']);

            // Unique constraint to prevent duplicate views within a short time
            $table->unique(['entity_type', 'entity_id', 'fingerprint', 'viewed_at'], 'unique_view_log');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_logs');
    }
};
