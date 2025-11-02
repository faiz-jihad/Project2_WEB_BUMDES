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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_pemesan');
            $table->text('alamat');
            $table->string('no_hp');
            $table->enum('metode_pembayaran', ['transfer', 'cod']);
            $table->enum('status', ['pending', 'sudah_bayar', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])->default('pending');
            $table->json('items'); // Store cart items as JSON
            $table->decimal('total_harga', 15, 2);
            $table->text('catatan')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
