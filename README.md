# Project2_WEB_BUMDES: Sistem Informasi Manajemen BUMDES

## Deskripsi Proyek

Repositori ini berisi kode sumber untuk pengembangan **Sistem Informasi Manajemen Badan Usaha Milik Desa (BUMDES)**. Aplikasi web ini dikembangkan dengan tujuan untuk memodernisasi dan mempermudah pengelolaan data operasional, inventaris, keuangan, serta informasi produk/layanan BUMDES.

Proyek ini dikembangkan sebagai bagian dari tugas akhir/proyek kelompok mata kuliah [**Proyek 2**] oleh Kelompok 5 

## Fitur Utama

Sistem ini dirancang untuk memiliki fungsionalitas utama sebagai berikut (silakan disesuaikan dengan fitur aktual):

1.  **Dashboard Administratif:** Ringkasan visual performa dan data operasional BUMDES.
2.  **Manajemen Produk/Layanan:** CRUD (Create, Read, Update, Delete) untuk mengelola daftar barang atau layanan yang ditawarkan BUMDES.
3.  **Manajemen Inventaris:** Pencatatan stok barang, mutasi barang masuk dan keluar.
4.  **Laporan Data:** Modul untuk menghasilkan laporan periodik (misalnya: laporan penjualan atau stok).
5.  **Manajemen Pengguna:** Pengaturan akun dan *role access* (Admin, Karyawan, dll.).
6.  **Halaman Publik:** Halaman depan yang menampilkan profil BUMDES dan katalog produk untuk masyarakat umum.

## Teknologi yang Digunakan

Proyek ini dibangun menggunakan arsitektur modern dengan kerangka kerja (framework) utama:

| Kategori | Teknologi |
| :--- | :--- |
| **Framework Backend** | PHP **Laravel** |
| **Database** | MySQL / MariaDB |
| **Frontend Styling** | Tailwind CSS |
| **Package Management** | Composer (PHP) & NPM/Node.js (Frontend) |

## Instalasi dan Setup Proyek

Ikuti langkah-langkah berikut untuk menjalankan aplikasi ini di lingkungan lokal Anda.

### Prasyarat

Pastikan Anda telah menginstal perangkat lunak berikut:
* PHP (direkomendasikan versi yang kompatibel dengan Laravel)
* Composer
* Node.js & NPM
* Database Server (MySQL atau MariaDB)

### Langkah-Langkah

1.  **Clone Repositori:**
    ```bash
    git clone [https://github.com/faiz-jihad/Project2_WEB_BUMDES.git](https://github.com/faiz-jihad/Project2_WEB_BUMDES.git)
    cd Project2_WEB_BUMDES
    ```

2.  **Instal Dependensi Backend:**
    ```bash
    composer install
    ```

3.  **Instal Dependensi Frontend:**
    ```bash
    npm install
    ```

4.  **Konfigurasi Environment:**
    Salin file environment contoh menjadi file `.env`:
    ```bash
    cp .env.temp .env
    ```

5.  **Generate App Key:**
    ```bash
    php artisan key:generate
    ```

6.  **Konfigurasi Database:**
    Buka file `.env` dan atur detail koneksi database Anda:
    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=project_bumdes
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    (Ganti `project_bumdes`, `root`, dan *password* sesuai konfigurasi lokal Anda)

7.  **Jalankan Migrasi Database:**
    Buat tabel dan jalankan *seeder* (jika ada data awal):
    ```bash
    php artisan migrate --seed
    ```

8.  **Kompilasi Aset Frontend:**
    Jalankan *watcher* selama pengembangan:
    ```bash
    npm run dev
    ```
    Atau untuk kompilasi versi produksi:
    ```bash
    npm run build
    ```

9.  **Jalankan Server Lokal:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan dapat diakses di `http://127.0.0.1:8000`.
## Web
www.bumdesmadusari.my.id

## Lisensi

Proyek ini dilisensikan di bawah [Lisensi MIT](https://opensource.org/licenses/MIT).
