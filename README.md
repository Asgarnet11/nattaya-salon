# Sistem Booking Nattaya Salon Kendari

Ini adalah sistem informasi dan manajemen booking online yang dibangun khusus untuk Nattaya Salon Kendari. Aplikasi ini dikembangkan menggunakan framework **PHP CodeIgniter 4** dengan database MySQL.

Sistem ini memiliki dua sisi utama: **frontend** yang elegan untuk pelanggan dan **backend (panel admin)** yang kuat untuk manajemen operasional salon.

---

## Fitur Utama

### 👤 Frontend (Untuk Pelanggan)

- **Pendaftaran & Login Pelanggan:** Pelanggan wajib memiliki akun untuk melakukan booking, memungkinkan adanya riwayat dan database pelanggan.
- **Katalog Layanan Dinamis:** Menampilkan daftar layanan utama, lengkap dengan galeri multi-gambar dan daftar paket harga yang bervariasi.
- **Formulir Booking Cerdas:**
  - Pemilihan cabang.
  - Dropdown dinamis untuk memilih layanan, lalu paket yang tersedia.
  - Pemilihan tanggal dan waktu.
- **Riwayat Booking:** Pelanggan dapat melihat semua riwayat transaksi booking yang pernah dilakukan.
- **Halaman Artikel/Blog:** Untuk konten marketing dan tips kecantikan.
- **Halaman Lokasi:** Menampilkan semua cabang salon di peta interaktif.

### ⚙️ Backend (Panel Admin)

- **Login Admin Terpisah & Aman:** Alur login yang sepenuhnya terpisah dari pelanggan.
- **Dashboard Analitik:** Menampilkan statistik kunci (booking pending, booking hari ini), daftar booking terbaru, dan grafik tren booking mingguan.
- **Manajemen Booking & Kalender:**
  - Melihat semua booking masuk dalam format tabel atau **kalender interaktif**.
  - Mengubah status booking (pending, confirmed, completed, canceled).
  - Menugaskan karyawan ke sebuah booking.
- **Manajemen Layanan & Paket:**
  - Membuat layanan utama (cth: Facial Treatment).
  - Menambah, mengedit, dan menghapus beberapa paket harga di bawah satu layanan (cth: Paket Basic, Paket Gold).
  - Mengupload banyak gambar untuk setiap layanan.
- **Manajemen User (Admin & Superadmin):**
  - Perbedaan hak akses antara superadmin (akses penuh) dan admin (manajer cabang).
  - Admin cabang hanya bisa melihat data yang relevan dengan cabangnya.
- **Manajemen Konten:** CRUD lengkap untuk Galeri, Artikel, Karyawan, dan Cabang.

---

## 💻 Tumpukan Teknologi (Tech Stack)

- **Framework:** CodeIgniter 4.6.3
- **Bahasa:** PHP 8.2+
- **Database:** MySQL (via MariaDB di XAMPP)
- **Frontend:** Bootstrap 5.3, JavaScript, FullCalendar.js, Chart.js
- **Server Lokal:** XAMPP

---

## 🚀 Cara Instalasi

Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan pengembangan lokal.

### Prasyarat

- **XAMPP** (dengan PHP 8.1+)
- **Composer**

### 1. Clone atau Unduh Proyek

Salin semua file proyek ke dalam folder `htdocs` di direktori XAMPP Anda.

### 2. Instalasi Dependensi

Buka terminal atau CMD di direktori utama proyek, lalu jalankan:

```bash
composer install
```

### 3. Konfigurasi Database

Buka phpMyAdmin, buat database baru dengan nama `db_nattaya_salon`

Impor file .sql yang disediakan atau jalankan migrasi dari awal. Untuk menjalankan migrasi, gunakan perintah:

```bash
php spark migrate
```

### 4. Konfigurasi Environment (.env)

Salin atau rename file env menjadi .env.

Buka file .env dan sesuaikan konfigurasi berikut:

Cuplikan kode

# Atur lingkungan ke development

CI_ENVIRONMENT = development

# Atur URL dasar sesuai server Anda

app.baseURL = 'http://localhost:8080/'

# Konfigurasi database Anda

```bash
database.default.hostname = localhost
database.default.database = db_nattaya_salon
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

### 5. Buat Akun Admin Awal

Jalankan perintah SQL berikut di phpMyAdmin untuk membuat akun superadmin pertama:

SQL

```bash
INSERT INTO `users` (`nama_lengkap`, `username`, `password`, `role`) VALUES
('Super Administrator', 'superadmin', '$2y$10$wL4Pmo621yP8.g0YpPlPHeLfG8bCNh3/D1bB2B.aI1D5.F3f/i43O', 'superadmin');
Password: admin123
```

6. Jalankan Aplikasi
   Kembali ke terminal Anda dan jalankan server pengembangan CodeIgniter:

```bash
php spark serve
```

Aplikasi sekarang berjalan di http://localhost:8080.

Halaman Pelanggan: http://localhost:8080

Halaman Login Admin: http://localhost:8080/admin/login
