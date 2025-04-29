# Blog Sederhana

Aplikasi blog sederhana menggunakan PHP, MySQL, dan CSS.

## Fitur
- Menambahkan artikel baru dengan gambar, kategori, dan penulis.
- Melihat daftar artikel dengan tampilan kartu (card) yang rapi.
- Melihat detail artikel secara lengkap di halaman khusus.
- Upload gambar dan menampilkannya pada setiap artikel.

## Teknologi
- **Frontend**: HTML, CSS
- **Backend**: PHP (Native)
- **Database**: MySQL
- **Server Lokal**: XAMPP

## Struktur Folder
```
/blog 
  ├── index.php ← Halaman utama (daftar artikel) 
  ├── detail.php ← Halaman detail artikel 
  ├── tambah-artikel.php ← Form untuk menambah artikel baru 
  ├── simpan-artikel.php ← Proses penyimpanan artikel baru 
  ├── style.css ← Styling CSS 
  ├── /images ← Folder gambar artikel 
  └── /koneksi 
    └── koneksi.php ← Koneksi database
```
## Cara Menjalankan
1. Pastikan XAMPP sudah terinstall dan aktifkan **Apache** dan **MySQL**.
2. Taruh folder `blog` ke dalam `htdocs`.
3. Import file database `dbcms.sql` ke dalam phpMyAdmin.
4. Akses melalui browser:

## Lisensi
Proyek ini dibuat untuk tujuan pembelajaran. Silakan digunakan atau dimodifikasi sesuai kebutuhan.
