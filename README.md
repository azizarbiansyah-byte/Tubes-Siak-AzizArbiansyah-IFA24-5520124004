# SIAKAD — Sistem Informasi Akademik

Aplikasi web berbasis **Laravel** yang mensimulasikan Sistem Informasi Akademik Dibangun Untuk Memenuhi Tugas Besar Mata Kuliah Web II — Universitas Suryakancana Cianjur.


## Teknologi yang Digunakan

- **Framework:** Laravel 12
- **Autentikasi:** Laravel Breeze
- **Role & Permission:** Spatie Laravel Permission
- **Frontend:** Bootstrap 5
- **Database:** MySQL
- **PDF Export:** Laravel DomPDF
- **Dropdown Search:** Select2

---

## Fitur Utama

### Autentikasi
- Login menggunakan **Username** dan **Password**
- 2 Role: **Admin** dan **Mahasiswa**
- Restrict halaman berdasarkan role

### Admin
- Kelola data **Dosen** (CRUD)
- Kelola data **Mahasiswa** (CRUD) — akun login mahasiswa dibuat secara otomatis
- Kelola data **Mata Kuliah** (CRUD)
- Kelola data **Jadwal Perkuliahan** (CRUD)
- Search data
- Pagination

### Mahasiswa
- Melihat **Jadwal Perkuliahan**
- Mengelola **KRS** (Kartu Rencana Studi):
  - Ambil mata kuliah
  - Drop mata kuliah
  - Batas maksimal **24 SKS**
  - Export KRS ke **PDF**

Akses Apilikasi URL : 

## Akun Default

| Role | Username | Password |
|---|---|---|
| Admin | `admin` | `admin123` |
| Mahasiswa | Nama Lengkap | NPM |

## Informasi Pengembang

| | |
|---|---|
| **Nama** | Aziz Arbiansyah|
| **NPM** | 5520124004 |
| **Kelas** | IF A 24 |
| **Mata Kuliah** | Pemrograman Web II (IF45123) |
| **Dosen** | Lalan Jaelani, ST., M.Kom |
| **Universitas** | Universitas Suryakancana Cianjur |
