# Sistem Inventaris Alat Olahraga

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![Laravel](https://img.shields.io/badge/laravel-12.x-red.svg)
![PHP](https://img.shields.io/badge/php-8.2+-blue.svg)

Sistem Inventaris Alat Olahraga adalah aplikasi berbasis web yang dikembangkan untuk membantu manajemen inventaris alat olahraga di sekolah secara efisien. Sistem ini memungkinkan administrator untuk mengelola inventaris dan memungkinkan pengguna untuk meminjam peralatan.

## 📖 Tentang Proyek

Proyek ini bertujuan untuk membangun sistem manajemen inventaris alat olahraga menggunakan framework Laravel. Sistem ini mendukung login admin, manajemen peralatan, permintaan peminjaman, dan alur kerja persetujuan, semua disajikan dalam desain yang responsif dan menarik secara visual.

## 🌟 Fitur

### Fitur Admin

-   **Autentikasi**: Login menggunakan username dan password
-   **Dashboard**: Tampilan tabel peralatan olahraga dengan detail (ID, nama, status, gambar, jumlah)
-   **Manajemen Peralatan**:
    -   Tambah peralatan baru
    -   Edit detail peralatan
    -   Hapus peralatan
-   **Manajemen Peminjaman**:
    -   Tampilan tabel permintaan peminjaman dengan detail (nama peminjam, item, jumlah, tanggal pinjam, tanggal kembali)
    -   Persetujuan atau penolakan permintaan

### Fitur Pengguna

-   **Penjelajahan Peralatan**: Tampilan peralatan olahraga yang tersedia dalam format kartu dengan detail (gambar, status, jumlah)
-   **Formulir Peminjaman**:
    -   Input: nama peminjam, nama item, jumlah, tanggal pinjam, tanggal kembali
    -   Pengiriman formulir untuk membuat permintaan peminjaman

### Fitur Tambahan

-   **Pencarian dan Pagination**: Pencarian peralatan dengan pagination di halaman pengguna
-   **Pratinjau Gambar**: Pratinjau gambar peralatan saat memilih di formulir peminjaman
-   **Auto Seleksi**: Otomatis memilih peralatan saat klik "Pinjam" dari halaman daftar peralatan
-   **Desain Responsif**: Tampilan yang responsif untuk desktop dan mobile
-   **Notifikasi**: Penggunaan SweetAlert2 untuk notifikasi interaktif

## 🛠️ Teknologi yang Digunakan

-   **[Laravel 12](https://laravel.com/)** - Framework PHP untuk pengembangan web
-   **[Tailwind CSS](https://tailwindcss.com/)** - Framework CSS untuk desain responsif
-   **[Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze)** - Starter kit autentikasi
-   **[SweetAlert2](https://sweetalert2.github.io/)** - Library untuk alert yang menarik
-   **[Font Awesome](https://fontawesome.com/)** - Library ikon
-   **PHP 8.2+**
-   **SQLite/MySQL** - Database
-   **Composer** - Dependency Manager untuk PHP
-   **NPM** - Package Manager untuk JavaScript

## 🚀 Instalasi

### Prasyarat

-   PHP >= 8.2
-   Composer
-   Node.js dan NPM
-   Database (SQLite/MySQL/PostgreSQL)
-   Web Server (Apache/Nginx) atau Laravel Valet

### Langkah-langkah Instalasi

1. **Clone Repository**

    ```bash
    git clone https://github.com/username/inventaris-olahraga.git
    cd inventaris-olahraga
    ```

2. **Install Dependencies PHP**

    ```bash
    composer install
    ```

3. **Install Dependencies JavaScript**

    ```bash
    npm install
    ```

4. **Copy dan Konfigurasi Environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Konfigurasi Database**
   Edit file `.env` dan sesuaikan konfigurasi database:

    ```env
    DB_CONNECTION=sqlite
    # atau untuk MySQL:
    # DB_CONNECTION=mysql
    # DB_HOST=127.0.0.1
    # DB_PORT=3306
    # DB_DATABASE=nama_database
    # DB_USERNAME=username
    # DB_PASSWORD=password
    ```

6. **Jalankan Migrations dan Seeds**

    ```bash
    php artisan migrate
    php artisan db:seed --class=AdminUserSeeder
    ```

7. **Compile Assets**

    ```bash
    npm run dev
    # atau untuk produksi:
    # npm run build
    ```

8. **Jalankan Server**

    ```bash
    php artisan serve
    ```

9. **Akses Aplikasi**
   Buka browser dan akses `http://localhost:8000`

### Kredensial Default

-   **Admin Login**:
    -   Email: `admin@example.com`
    -   Password: `password`

## 🎮 Cara Penggunaan

### Untuk Administrator

1. **Login**: Akses halaman login dan masuk menggunakan kredensial admin
2. **Dashboard**: Lihat semua peralatan olahraga dalam bentuk tabel
3. **Manajemen Peralatan**:
    - Klik "Add Equipment" untuk menambah peralatan baru
    - Gunakan tombol "Edit" untuk mengedit detail peralatan
    - Gunakan tombol "Delete" untuk menghapus peralatan
4. **Manajemen Peminjaman**:
    - Akses menu "Borrow Requests" untuk melihat semua permintaan
    - Gunakan tombol "Approve" atau "Decline" untuk memproses permintaan

### Untuk Pengguna Umum

1. **Halaman Utama**: Akses halaman utama untuk melihat peralatan yang tersedia
2. **Pencarian**: Gunakan fitur pencarian untuk mencari peralatan tertentu
3. **Pagination**: Gunakan navigasi halaman untuk melihat lebih banyak peralatan
4. **Pinjam Peralatan**:
    - Klik tombol "Request to Borrow" pada kartu peralatan
    - Isi formulir peminjaman dengan data yang diperlukan
    - Lihat pratinjau gambar peralatan sebelum mengirim
    - Kirim permintaan peminjaman

## 🗄️ Struktur Database

Database: `db_alatolahraga`

### Tabel: `users`

| Kolom    | Tipe Data | Deskripsi         |
| -------- | --------- | ----------------- |
| id       | bigint    | ID unik pengguna  |
| name     | varchar   | Nama pengguna     |
| email    | varchar   | Email pengguna    |
| password | varchar   | Password pengguna |

### Tabel: `sports_equipment`

| Kolom         | Tipe Data | Deskripsi                                |
| ------------- | --------- | ---------------------------------------- |
| id            | bigint    | ID unik peralatan                        |
| item_name     | varchar   | Nama peralatan                           |
| item_status   | varchar   | Status peralatan (available/unavailable) |
| item_image    | varchar   | Path gambar peralatan (opsional)         |
| item_quantity | int       | Jumlah peralatan tersedia                |

### Tabel: `borrow_requests`

| Kolom         | Tipe Data | Deskripsi                                     |
| ------------- | --------- | --------------------------------------------- |
| id            | bigint    | ID unik permintaan                            |
| borrower_name | varchar   | Nama peminjam                                 |
| item_name     | varchar   | Nama peralatan yang dipinjam                  |
| quantity      | int       | Jumlah yang dipinjam                          |
| borrow_date   | date      | Tanggal peminjaman                            |
| return_date   | date      | Tanggal pengembalian                          |
| status        | varchar   | Status permintaan (pending/approved/declined) |

## 🤝 Kontribusi

Kontribusi sangat diharapkan! Untuk berkontribusi:

1. Fork proyek ini
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buka Pull Request
