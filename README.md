# 📚 BookStore - Sistem Manajemen & Katalog Toko Buku Online

Aplikasi web e-commerce dan manajemen inventaris toko buku berbasis **Laravel 11**, **PHP 8.3**, **MySQL**, dan **Bootstrap 5**. Dibuat dengan arsitektur MVC yang bersih, aman, responsif, dan siap digunakan untuk kebutuhan operasional maupun penilaian sertifikasi/pelatihan web.

---

## 🌟 Fitur Utama

### 1. 👥 Pengunjung (Guest / Pre-Login)
* **Landing Page Modern:** Tampilan beranda eksklusif bertema *Forest Green & Gold/Ochre*, dilengkapi Hero Banner, Nilai Tambah Toko, Pratinjau Buku Pilihan, dan Call to Action.
* **Katalog & Pencarian Real-Time:** Menampilkan daftar buku lengkap dengan filter kategori, pencarian judul/penulis, dan paginasi otomatis.
* **Halaman Informasi:** Halaman Tentang Kami (*About Us*) dan Formulir Kontak Layanan Pelanggan.
* **Autentikasi Mandiri:** Registrasi pengguna baru serta Login dengan fitur intip kata sandi (*Show/Hide Password toggle*).

### 2. 🛒 Pelanggan (Customer / User)
* **Keranjang Belanja Interaktif:**
  * Tambah buku ke keranjang dengan validasi ketersediaan stok fisik.
  * Fitur instan **"Beli Semua (Maks Stok)"** untuk membeli sisa stok barang dalam 1 klik.
  * Auto-save keranjang belanja berbasis session & database.
* **Alur Checkout Terpadu:** Pengisian nama penerima, alamat pengiriman, dan ringkasan tagihan belanja.
* **Metode Pembayaran Digital:**
  * 📱 **QRIS:** Tampilan barcode QRIS interaktif untuk semua e-wallet dan m-banking.
  * 🟢 **GoPay:** Pembayaran dompet digital cepat.
  * 🏦 **Transfer Bank:** Rincian nomor rekening dan instruksi transfer.
* **Riwayat & Detail Transaksi:** Pantau status pemesanan secara berkala (*Menunggu Pembayaran*, *Diproses*, *Dikirim*, *Selesai*, *Dibatalkan*).

### 3. ⚙️ Administrator (Admin Panel)
* **Dashboard Statistik:** Ringkasan total pendapatan, jumlah transaksi, total buku, dan total pengguna terdaftar.
* **Kelola Data Buku (CRUD):** Tambah, lihat, ubah, dan hapus data buku lengkap dengan foto cover, harga, penulis, penerbit, dan stok fisik.
* **Validasi Anti-Duplikasi:** Judul buku dicegah dari duplikasi (*unique validation*) pada form tambah maupun ubah.
* **Kelola Kategori:** Manajemen kategori buku dinamis.
* **Kelola Pesanan Masuk:** Verifikasi dan pembaruan status transaksi pesanan pelanggan secara langsung.

### 4. 🛡️ Keamanan & Keandalan (Best Practices)
* **Proteksi Concurrency & Anti-Overselling:** Menggunakan database transaction dan pessimistic locking (`lockForUpdate()`) agar stok buku tidak pernah bernilai minus meskipun dibeli secara bersamaan.
* **Enkripsi Kata Sandi:** Hashing kata sandi menggunakan standar Bcrypt (`Hash::make`).
* **CSRF & XSS Protection:** Dilengkapi token CSRF pada seluruh form submission dan sanitasi data Blade.
* **Clean Code:** Kode terformat rapi sesuai standar PSR-12 menggunakan Laravel Pint.

---

## 🛠️ Tech Stack & Prasyarat

* **Framework:** Laravel 11.x
* **Bahasa:** PHP >= 8.2 (Direkomendasikan PHP 8.3)
* **Database:** MySQL / MariaDB 10.4+
* **Frontend:** Blade Templating, Bootstrap 5.3, Bootstrap Icons, Vanilla JS
* **Tooling:** Composer, Laragon / XAMPP

---

## 🚀 Panduan Instalasi & Menjalankan Proyek

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lingkungan lokal:

### 1. Clone Repository
```bash
git clone https://github.com/Heikkakeren/bookstore.git
cd bookstore
```

### 2. Install Dependensi PHP
```bash
composer install
```

### 3. Konfigurasi Environment (`.env`)
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
Buka file `.env` dan sesuaikan konfigurasi database Anda (contoh untuk Laragon/XAMPP default):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_bookstore
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Setup Database & Data Awal
Buat database bernama `db_bookstore` di phpMyAdmin / MySQL client Anda. Kemudian pilih salah satu opsi di bawah ini:

* **Opsi A (Rekomendasi - Menggunakan file SQL yang sudah disediakan):**
  Import langsung file `database.sql` yang berada di direktori root proyek ini ke dalam database `db_bookstore`.
  ```bash
  mysql -u root db_bookstore < database.sql
  ```

* **Opsi B (Menggunakan Artisan Migration & Seeder):**
  ```bash
  php artisan migrate --seed
  ```

### 6. Hubungkan Storage Simbolik (Storage Link)
Pastikan folder aset gambar cover buku terhubung ke folder public:
```bash
php artisan storage:link
```

### 7. Jalankan Server Lokal
```bash
php artisan serve
```
Akses aplikasi melalui browser di alamat:
👉 **[http://localhost:8000](http://localhost:8000)** (atau `http://bookstore.test` jika menggunakan virtual host Laragon).

---

## 🔑 Akun Demo / Pengujian

Untuk keperluan evaluasi, pengujian fitur, atau penilaian, gunakan akun bawaan berikut:

| Peran (Role) | Email | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin@bookstore.test` | `password` atau `password123` | Akses penuh Dashboard Admin, CRUD Buku, Kategori, & Pesanan |
| **Pelanggan (User)** | `user@bookstore.test` | `password` atau `password123` | Akses Katalog, Keranjang, Checkout QRIS/GoPay, & Riwayat Pesanan |

---

## 📁 Struktur Direktori Penting

```plaintext
bookstore/
├── app/
│   ├── Http/Controllers/       # Logika alur Auth, Book, Cart, Checkout, Admin, dll.
│   └── Models/                 # Eloquent Models (User, Book, Category, Order, Cart)
├── database/
│   ├── migrations/             # Skema tabel database
│   └── seeders/                # Data awal untuk pengujian
├── public/                     # Asset public (CSS, JS, symlink storage)
├── resources/
│   └── views/                  # Tampilan UI Blade (Landing, Auth, Admin, User)
├── routes/
│   └── web.php                 # Definisi rute aplikasi
├── storage/app/public/covers/  # Aset cover buku awal
├── database.sql                # Dump database lengkap siap import
└── README.md                   # Dokumentasi proyek
```

---

## 👨‍💻 Author

* **Nama:** Magfi Adi Radza Putra ([@Heikkakeren](https://github.com/Heikkakeren))
* **Email:** radzaadi@gmail.com
* **Repository:** [https://github.com/Heikkakeren/bookstore](https://github.com/Heikkakeren/bookstore)
