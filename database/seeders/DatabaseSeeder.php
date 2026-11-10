<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin Default
        User::firstOrCreate(
            ['email' => 'admin@bookstore.test'],
            [
                'name' => 'Administrator',
                'email' => 'admin@bookstore.test',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'phone' => '08123456789',
                'address' => 'Jl. Admin No. 1, Jakarta Pusat',
                'email_verified_at' => now(),
            ]
        );

        // 2. Akun User Default
        User::firstOrCreate(
            ['email' => 'user@bookstore.test'],
            [
                'name' => 'John Doe',
                'email' => 'user@bookstore.test',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'phone' => '08198765432',
                'address' => 'Jl. User No. 5, Bandung',
                'email_verified_at' => now(),
            ]
        );

        // 3. Kategori Buku
        $teknologi = Category::firstOrCreate(
            ['slug' => 'teknologi-informasi'],
            ['name' => 'Teknologi Informasi', 'slug' => 'teknologi-informasi']
        );

        $fiksi = Category::firstOrCreate(
            ['slug' => 'fiksi'],
            ['name' => 'Fiksi', 'slug' => 'fiksi']
        );

        $bisnis = Category::firstOrCreate(
            ['slug' => 'bisnis-ekonomi'],
            ['name' => 'Bisnis & Ekonomi', 'slug' => 'bisnis-ekonomi']
        );

        // 4. Data Buku & Stok (Tabel stocks terpisah 1:1) beserta Cover Image Asli
        $booksData = [
            [
                'category_id' => $teknologi->id,
                'title' => 'Pemrograman Laravel untuk Pemula',
                'author' => 'Budi Santoso',
                'publisher' => 'Penerbit Informatika',
                'price' => 125000,
                'stock' => 50,
                'cover_image' => 'covers/laravel.jpg',
                'description' => 'Buku panduan lengkap belajar framework Laravel dari nol hingga mahir. Cocok untuk pemula yang ingin membangun aplikasi web modern dengan PHP 8 dan arsitektur MVC.',
            ],
            [
                'category_id' => $teknologi->id,
                'title' => 'Belajar Python dari Nol',
                'author' => 'Rina Wati',
                'publisher' => 'Elex Media Komputindo',
                'price' => 98000,
                'stock' => 35,
                'cover_image' => 'covers/python.jpg',
                'description' => 'Panduan lengkap belajar bahasa pemrograman Python dari dasar hingga mahir. Dilengkapi latihan logika coding, struktur data, dan proyek aplikasi nyata.',
            ],
            [
                'category_id' => $fiksi->id,
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka',
                'price' => 79000,
                'stock' => 100,
                'cover_image' => 'covers/laskar-pelangi.jpg',
                'description' => 'Novel inspiratif tentang perjuangan anak-anak Belitung dalam menggapai mimpi di tengah keterbatasan. Karya sastra monumental Indonesia yang mendunia.',
            ],
            [
                'category_id' => $fiksi->id,
                'title' => 'Bumi',
                'author' => 'Tere Liye',
                'publisher' => 'Gramedia Pustaka Utama',
                'price' => 89000,
                'stock' => 75,
                'cover_image' => 'covers/bumi.jpg',
                'description' => 'Novel fantasi seri Bumi karya Tere Liye. Kisah petualangan seru Raib, Seli, dan Ali menjelajahi dunia paralel penuh misteri dan kekuatan luar biasa.',
            ],
            [
                'category_id' => $bisnis->id,
                'title' => 'Rich Dad Poor Dad',
                'author' => 'Robert T. Kiyosaki',
                'publisher' => 'Gramedia Pustaka Utama',
                'price' => 109000,
                'stock' => 60,
                'cover_image' => 'covers/rich-dad.jpg',
                'description' => 'Buku literasi keuangan terbaik dunia tentang perbedaan pola pikir orang kaya dan orang miskin terhadap uang, aset, dan investasi kebebasan finansial.',
            ],
            [
                'category_id' => $bisnis->id,
                'title' => 'Zero to One',
                'author' => 'Peter Thiel',
                'publisher' => 'Currency',
                'price' => 135000,
                'stock' => 40,
                'cover_image' => 'covers/zero-to-one.jpg',
                'description' => 'Panduan membangun startup inovatif dari tokoh pendiri PayPal. Pelajari cara menciptakan produk orisinal dan bernilai tinggi dari nol menjadi satu.',
            ],
        ];

        foreach ($booksData as $data) {
            $stockQuantity = $data['stock'];
            unset($data['stock']);

            $book = Book::firstOrCreate(
                ['title' => $data['title']],
                $data
            );

            // Perbarui cover jika belum ada atau berbeda
            if ($book->cover_image !== $data['cover_image']) {
                $book->update(['cover_image' => $data['cover_image']]);
            }

            // Seed record di tabel stocks (1:1)
            $book->stock()->updateOrCreate(
                ['book_id' => $book->id],
                ['quantity' => $stockQuantity]
            );
        }
    }
}
