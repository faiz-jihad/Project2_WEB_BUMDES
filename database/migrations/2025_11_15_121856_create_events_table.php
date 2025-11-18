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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_type'); // user_visit, user_click, user_share, open_detail, etc.
            $table->string('entity_type')->nullable(); // App\Models\Berita, App\Models\Produk, etc.
            $table->unsignedBigInteger('entity_id')->nullable(); // ID of the entity
            $table->unsignedBigInteger('user_id')->nullable(); // User who triggered the event
            $table->string('session_id')->nullable(); // Session identifier
            $table->string('ip_address')->nullable(); // IP address
            $table->text('user_agent')->nullable(); // Browser user agent
            $table->json('metadata')->nullable(); // Additional data like referrer, page_url, etc.
            $table->timestamp('occurred_at'); // When the event occurred
            $table->timestamps();

            // Indexes for performance
            $table->index(['event_type', 'occurred_at']);
            $table->index(['entity_type', 'entity_id']);
            $table->index(['user_id']);
            $table->index(['session_id']);
            $table->index(['ip_address']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
