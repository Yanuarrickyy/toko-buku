<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key ke users
            $table->foreignId('buku_id')->constrained('buku')->onDelete('cascade'); // Foreign key ke buku
            $table->date('tanggal_transaksi');
            $table->integer('jumlah');
            $table->decimal('harga', 10, 2);
            $table->decimal('total_harga', 15, 2)->nullable(); // Kolom total harga
            $table->decimal('pembayaran', 15, 2)->nullable(); // Kolom pembayaran
            $table->decimal('kembalian', 15, 2)->nullable(); // Kolom kembalian
            $table->enum('status', ['pending', 'selesai'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
}
