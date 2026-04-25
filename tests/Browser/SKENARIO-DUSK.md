# Skenario Uji Dusk - EAD Library

Dokumen ini mendefinisikan skenario pengujian end-to-end berbasis Laravel Dusk untuk aplikasi CRUD buku dengan autentikasi.

## Prasyarat

1. Database testing siap digunakan.
2. Browser driver untuk Dusk sudah dikonfigurasi.
3. Jalankan migration dan seed jika dibutuhkan.
4. Jalankan test dari root project.

## Daftar Skenario

### 1. Registrasi Berhasil
- Tujuan: Memastikan user baru bisa register dan diarahkan ke dashboard buku.
- Langkah:
  1. Buka halaman `/register`.
  2. Isi nama, email unik, password, konfirmasi password.
  3. Klik tombol `Register`.
- Ekspektasi:
  1. Berpindah ke path `/books`.
  2. Muncul pesan `Registrasi berhasil.`.
  3. Halaman menampilkan `Daftar Buku`.

### 2. Login Berhasil
- Tujuan: Memastikan user terdaftar bisa login.
- Langkah:
  1. Buka halaman `/login`.
  2. Isi email dan password valid.
  3. Klik tombol `Login`.
- Ekspektasi:
  1. Berpindah ke path `/books`.
  2. Muncul pesan `Login berhasil.`.
  3. Halaman menampilkan daftar buku.

### 3. Tambah Buku Berhasil
- Tujuan: Memastikan alur create data buku berjalan.
- Langkah:
  1. Login sebagai user valid.
  2. Buka `/books/create`.
  3. Isi form buku lengkap.
  4. Klik `Simpan Buku`.
- Ekspektasi:
  1. Data buku tersimpan.
  2. Muncul pesan `Buku berhasil ditambahkan.`.
  3. Judul buku terlihat pada halaman hasil.

### 4. Lihat Detail Buku
- Tujuan: Memastikan halaman detail bisa diakses.
- Langkah:
  1. Login sebagai user.
  2. Akses halaman detail `/books/{id}`.
- Ekspektasi:
  1. Judul buku tampil.
  2. Penulis buku tampil.

### 5. Update Sengaja Gagal (Skenario Negatif)
- Tujuan: Memvalidasi alur gagal update sesuai kebutuhan pengujian.
- Langkah:
  1. Login sebagai user.
  2. Buka `/books/{id}/edit`.
  3. Ubah salah satu field lalu klik `Perbarui Buku`.
- Ekspektasi:
  1. Redirect kembali ke `/books` (dashboard).
  2. Muncul flash error `Buku gagal diperbarui.`.
  3. Data buku tidak berubah.

### 6. Hapus Buku Berhasil
- Tujuan: Memastikan alur delete dengan konfirmasi berjalan.
- Langkah:
  1. Login sebagai user.
  2. Buka halaman `/books`.
  3. Klik tombol hapus (ikon trash).
  4. Konfirmasi dialog hapus.
- Ekspektasi:
  1. Muncul pesan `Buku berhasil dihapus.`.
  2. Data buku tidak tampil lagi di tabel.

### 7. Logout Berhasil
- Tujuan: Memastikan user bisa logout setelah login.
- Langkah:
  1. Login menggunakan akun valid.
  2. Buka menu user (ikon user) di navbar.
  3. Klik tombol `Logout`.
- Ekspektasi:
  1. Redirect ke `/login`.
  2. Muncul pesan `Logout berhasil.`.

## Perintah Eksekusi

```bash
php artisan dusk --filter=Test
```

Jika ingin menjalankan seluruh skenario Dusk:

```bash
php artisan dusk
```
