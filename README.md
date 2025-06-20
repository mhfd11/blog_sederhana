# Blog Sederhana

Aplikasi blog sederhana berbasis **PHP Native** dengan sistem **multi-role (admin & penulis)**, **upload gambar**, dan tampilan modern menggunakan **HTML + CSS**.

## ✨ Fitur Utama

- 📰 Menambahkan, mengedit, dan menghapus **artikel** beserta gambar, kategori, dan penulis.
- 🧑‍💼 Sistem login multi-role: **Admin** & **Penulis** dengan dashboard masing-masing.
- 🗂️ **Manajemen kategori** dan **penulis** langsung dari dashboard admin.
- 📷 Upload dan tampilkan **gambar artikel**.
- 🔍 Fitur **pencarian** artikel dan **filter berdasarkan kategori**.
- 💻 Tampilan responsive & modern: **list artikel**, **sidebar**, dan **halaman detail**.

## 🔧 Teknologi Digunakan

- **Frontend**: HTML5, CSS3 (tanpa framework)
- **Backend**: PHP (Native)
- **Database**: MySQL
- **Server Lokal**: XAMPP

## 📁 Struktur Folder
/blog
├── index.php ← Halaman utama (daftar artikel terbaru)
├── detail.php ← Halaman detail artikel
├── search.php ← Hasil pencarian
├── kategori.php ← Filter artikel berdasarkan kategori
├── login.php ← Login multi-role
├── /admin ← Panel admin (dashboard, kelola artikel, kategori, penulis)
│ ├── dashboard.php
│ ├── artikel-list.php
│ ├── tambah-artikel.php
│ ├── edit-artikel.php
│ ├── kategori-list.php
│ ├── penulis-list.php
│ └── admin-style.css
├── /penulis ← Panel penulis (kelola artikel & profil)
│ ├── dashboard.php
│ ├── artikel-saya.php
│ ├── tambah-artikel.php
│ └── edit-artikel.php
├── /uploads ← Gambar artikel yang diupload
├── /koneksi
│ └── koneksi.php ← File koneksi database
├── style.css ← Styling halaman frontend
├── header.php ← Komponen header yang di-include di semua halaman
└── dbcms.sql ← File SQL untuk struktur dan data awal


## 🚀 Cara Menjalankan di Lokal

1. Pastikan **XAMPP** sudah terinstall.
2. Aktifkan **Apache** dan **MySQL** dari XAMPP Control Panel.
3. Letakkan folder `blog/` di dalam direktori `htdocs/`.
4. Buka **phpMyAdmin**, buat database `dbcms`, lalu **import** file `dbcms.sql`.
5. Buka di browser: `http://localhost/blog`

### 🔐 Login Admin & Penulis

> **Gunakan email & password dari tabel `author` di database.**
> Role tersedia: `admin` dan `penulis`.

## 📸 Screenshots

*Tambahkan tangkapan layar halaman dashboard, artikel, dll jika diperlukan.*

## 📄 Lisensi

Proyek ini dibuat untuk keperluan pembelajaran dan bebas digunakan untuk modifikasi atau pengembangan lebih lanjut.
