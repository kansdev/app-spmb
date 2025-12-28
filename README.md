<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/kansdev/app-spmb">
    <img src="https://img.shields.io/github/stars/kansdev/app-spmb" alt="Stars">
  </a>
  <a href="https://github.com/kansdev/app-spmb/issues">
    <img src="https://img.shields.io/github/issues/kansdev/app-spmb" alt="Issues">
  </a>
  <a href="https://github.com/kansdev/app-spmb/blob/main/LICENSE">
    <img src="https://img.shields.io/github/license/kansdev/app-spmb" alt="License">
  </a>
  <img src="https://img.shields.io/badge/PHP-%3E%3D8.2-blueviolet" alt="PHP Version">
  <img src="https://img.shields.io/badge/Laravel-12.x-red" alt="Laravel Version">
</p>

---

## Tentang Aplikasi

**SPMB (Seleksi Penerimaan Murid Baru)** adalah aplikasi berbasis web yang dikembangkan menggunakan **Laravel Framework** untuk membantu sekolah dalam mengelola proses **pendaftaran, seleksi, dan verifikasi calon peserta didik** secara online.

Aplikasi ini dirancang agar proses SPMB menjadi lebih:
- Efisien
- Transparan
- Terstruktur
- Mudah digunakan oleh panitia dan calon murid

---

## Fitur Utama

- Pendaftaran calon murid secara online
- Manajemen data pendaftar
- Upload dan verifikasi berkas persyaratan
- Penilaian & seleksi (nilai rapor, jalur, jurusan)
- Manajemen jurusan dan kuota
- Dashboard admin & panitia
- Export data pendaftar
- Sistem autentikasi & hak akses pengguna

---

## Teknologi yang Digunakan

- **Laravel Framework** ^10.x
- **PHP** >= 8.1
- **MySQL / MariaDB**
- **Bootstrap 5**
- **Nginx / Apache**
- **Git & GitHub**

---

## Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/kansdev/app-spmb.git
cd app-spmb
```
### 2. Install Depedency
```bash
composer install
```

### 3. Konfigurasi Environment
Salin file .env.example menjadi .env:
```bash
cp .env.example .env
```
Generate application key:
```bash
php artisan key:generate
```
Atur database di file .env:
- DB_DATABASE=spmb
- DB_USERNAME=root
- DB_PASSWORD=
Menjalankan Aplikasi
```bash
php artisan serve
```
Migrasi Database & Seeder
```bash
php artisan migrate --seed
```
Migrasi Database & Seeder
```bash
http://127.0.0.1:8000
```

### 4. Struktur Folder Penting
- **app/ – Logic utama aplikasi**
- **routes/ – Routing web & API**
- **resources/views/ – Blade template**
- **database/migrations/ – Struktur database**
- **public/ – Asset publik**

### 5. Kontribusi
Kontribusi sangat terbuka untuk pengembangan aplikasi ini.
Langkah kontribusi:
- Fork repository
- Buat branch fitur (feature/nama-fitur)
- Commit perubahan
- Ajukan Pull Request

### 6. Keamanan
Jika Anda menemukan kerentanan keamanan, silakan hubungi pengembang secara langsung dan jangan membuka issue publik.

### 7. Pengembang
Ade Maulana
Guru Produktif Pengembangan Perangkat Lunak
🌐 https://kansdev.my.id








