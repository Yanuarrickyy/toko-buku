<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;
use App\Models\Kategori;
use Faker\Factory as Faker;

class BukuSeeder extends Seeder
{
    /**
     * Menjalankan seeder untuk mengisi data buku.
     *
     * @return void
     */
    public function run()
    {
        // Ambil semua kategori yang ada di tabel kategori
        $kategori = Kategori::all();

        // Pastikan ada kategori di database sebelum memasukkan data buku
        if ($kategori->isEmpty()) {
            $this->command->info('Tidak ada kategori yang ditemukan, pastikan data kategori sudah ada.');
            return;
        }

        // Inisialisasi Faker untuk menghasilkan data palsu
        $faker = Faker::create('id_ID'); // Menggunakan lokal Indonesia

        // Menambahkan 20 data buku
        for ($i = 1; $i <= 20; $i++) {
            Buku::create([
                'kategori_id' => $kategori->random()->id_kategori, // Mengambil kategori secara acak
                'judul' => $faker->sentence(3), // Membuat judul buku secara acak
                'deskripsi' => $faker->paragraph(), // Membuat deskripsi buku secara acak
                'penulis' => $faker->name, // Nama penulis secara acak
                'cover' => 'https://via.placeholder.com/150', // URL gambar placeholder sebagai cover
                'status' => $faker->randomElement(['aktif', 'nonaktif']), // Status acak antara 'aktif' dan 'nonaktif'
            ]);
        }

        $this->command->info('20 data buku telah berhasil ditambahkan.');
    }
}
