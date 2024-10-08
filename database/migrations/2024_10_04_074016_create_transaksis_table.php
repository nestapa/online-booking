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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_product')->constrained('products')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_metode')->constrained('metode_pembayarans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('id_user_voucher')->nullable()->constrained('user_vouchers')->cascadeOnUpdate();
            $table->string('bukti_pembayaran');
            $table->string('berat_laundry');
            $table->string('tanggal_masuk');
            $table->string('tanggal_selesai');
            $table->string('poin_masuk');
            $table->string('total_harga');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
