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
        Schema::create('buku', function (Blueprint $table) {
            $table->integer('id_buku')->autoIncrement()->unsigned();
            $table->integer('kategori_id')->unsigned();
            $table->string('judul')->unique();
            $table->string('deskripsi');
            $table->string('penulis');
            $table->string('cover');
            $table->enum('status', ['aktif', 'aktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('kategori_id')->references('id_kategori')->on('kategori')
            ->onDelete('no action')
            ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};