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
        Schema::table('penjualan', function (Blueprint $table) {
            if (!Schema::hasColumn('penjualan', 'total_harga')) {
                $table->decimal('total_harga', 15, 2)->after('harga')->nullable();
            }
            if (!Schema::hasColumn('penjualan', 'pembayaran')) {
                $table->decimal('pembayaran', 15, 2)->after('total_harga')->nullable();
            }
            if (!Schema::hasColumn('penjualan', 'kembalian')) {
                $table->decimal('kembalian', 15, 2)->after('pembayaran')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            if (Schema::hasColumn('penjualan', 'total_harga')) {
                $table->dropColumn('total_harga');
            }
            if (Schema::hasColumn('penjualan', 'pembayaran')) {
                $table->dropColumn('pembayaran');
            }
            if (Schema::hasColumn('penjualan', 'kembalian')) {
                $table->dropColumn('kembalian');
            }
        });
    }
};
