## Skenario Uji Dusk - EAD Library

Skenario pengujian end-to-end berbasis Laravel Dusk untuk aplikasi CRUD buku dengan autentikasi.

### Prasyarat

1. Database testing siap digunakan.
2. Browser driver untuk Dusk sudah dikonfigurasi.
3. Jalankan migration dan seed jika dibutuhkan.
4. Jalankan test dari root project.

### Daftar Skenario

| No | Skenario | Tujuan | Langkah | Ekspektasi |
| --- | --- | --- | --- | --- |
| 1 | Registrasi Berhasil | Memastikan user baru bisa register dan diarahkan ke dashboard buku. | 1. Buka halaman `/register`.<br>2. Isi nama, email unik, password, konfirmasi password.<br>3. Klik tombol `Register`. | 1. Berpindah ke path `/books`.<br>2. Muncul pesan `Registrasi berhasil.`.<br>3. Halaman menampilkan `Daftar Buku`. |
| 2 | Login Berhasil | Memastikan user terdaftar bisa login. | 1. Buka halaman `/login`.<br>2. Isi email dan password valid.<br>3. Klik tombol `Login`. | 1. Berpindah ke path `/books`.<br>2. Muncul pesan `Login berhasil.`.<br>3. Halaman menampilkan daftar buku. |
| 3 | Tambah Buku Berhasil | Memastikan alur create data buku berjalan. | 1. Login sebagai user valid.<br>2. Klik menu `Tambah Buku` pada navbar.<br>3. Isi form buku lengkap.<br>4. Klik `Simpan Buku`. | 1. Data buku tersimpan.<br>2. Muncul pesan `Buku berhasil ditambahkan.`.<br>3. Judul buku terlihat pada halaman hasil. |
| 4 | Lihat Detail Buku | Memastikan halaman detail bisa diakses melalui navigasi UI. | 1. Login sebagai user.<br>2. Klik menu `Tambah Buku`, isi form lalu klik `Simpan Buku`.<br>3. Klik tombol `Kembali` ke daftar buku.<br>4. Klik link `Detail` pada baris buku yang dimaksud. | 1. Judul buku tampil pada halaman detail.<br>2. Penulis buku tampil pada halaman detail. |
| 5 | Update Sengaja Gagal (Negatif) | Memvalidasi alur gagal update sesuai kebutuhan pengujian. | 1. Login sebagai user.<br>2. Klik menu `Tambah Buku`, isi form lalu klik `Simpan Buku`.<br>3. Pada halaman detail, klik tombol `Edit Buku`.<br>4. Ubah salah satu field lalu klik `Perbarui Buku`. | 1. Redirect kembali ke `/books` (dashboard).<br>2. Muncul flash error `Buku gagal diperbarui.`.<br>3. Data buku tidak berubah (judul lama tetap muncul, judul baru tidak muncul). |
| 6 | Hapus Buku Berhasil | Memastikan alur delete dengan konfirmasi berjalan. | 1. Login sebagai user.<br>2. Klik menu `Tambah Buku`, isi form lalu klik `Simpan Buku`.<br>3. Klik tombol `Kembali` ke halaman `/books`.<br>4. Klik tombol hapus (ikon trash) pada baris buku.<br>5. Konfirmasi dialog hapus. | 1. Muncul pesan `Buku berhasil dihapus.`.<br>2. Data buku tidak tampil lagi di tabel. |
| 7 | Logout Berhasil | Memastikan user bisa logout setelah login. | 1. Login menggunakan akun valid.<br>2. Buka menu user (ikon user) di navbar.<br>3. Klik tombol `Logout`. | 1. Redirect ke `/login`.<br>2. Muncul pesan `Logout berhasil.`. |

### Test Scenarios (English)

| No | Scenario | Objective | Steps | Expectations |
| --- | --- | --- | --- | --- |
| 1 | Successful Registration | Ensure a new user can register and is redirected to the books dashboard. | 1. Open the `/register` page.<br>2. Fill in name, unique email, password, and password confirmation.<br>3. Click the `Register` button. | 1. Redirected to the `/books` path.<br>2. Message `Registrasi berhasil.` appears.<br>3. The page displays `Daftar Buku`. |
| 2 | Successful Login | Ensure a registered user can log in. | 1. Open the `/login` page.<br>2. Fill in valid email and password.<br>3. Click the `Login` button. | 1. Redirected to the `/books` path.<br>2. Message `Login berhasil.` appears.<br>3. The page displays the book list. |
| 3 | Successful Add Book | Ensure the book creation flow works. | 1. Log in as a valid user.<br>2. Click the `Tambah Buku` menu in the navbar.<br>3. Fill in the complete book form.<br>4. Click `Simpan Buku`. | 1. Book data is saved.<br>2. Message `Buku berhasil ditambahkan.` appears.<br>3. The book title is visible on the result page. |
| 4 | View Book Detail | Ensure the detail page can be accessed through UI navigation. | 1. Log in as a user.<br>2. Click the `Tambah Buku` menu, fill the form, and click `Simpan Buku`.<br>3. Click the `Kembali` button to return to the book list.<br>4. Click the `Detail` link on the target book row. | 1. The book title appears on the detail page.<br>2. The book author appears on the detail page. |
| 5 | Intentional Update Failure (Negative) | Validate the failing update flow as required by the test scenario. | 1. Log in as a user.<br>2. Click the `Tambah Buku` menu, fill the form, and click `Simpan Buku`.<br>3. On the detail page, click the `Edit Buku` button.<br>4. Change one of the fields and click `Perbarui Buku`. | 1. Redirected back to `/books` (dashboard).<br>2. Flash error `Buku gagal diperbarui.` appears.<br>3. Book data is unchanged (the old title still appears, the new title does not appear). |
| 6 | Successful Delete Book | Ensure the delete flow with confirmation works. | 1. Log in as a user.<br>2. Click the `Tambah Buku` menu, fill the form, and click `Simpan Buku`.<br>3. Click the `Kembali` button to return to the `/books` page.<br>4. Click the delete button (trash icon) on the book row.<br>5. Confirm the delete dialog. | 1. Message `Buku berhasil dihapus.` appears.<br>2. The book data no longer appears in the table. |
| 7 | Successful Logout | Ensure a user can log out after logging in. | 1. Log in using a valid account.<br>2. Open the user menu (user icon) in the navbar.<br>3. Click the `Logout` button. | 1. Redirected to `/login`.<br>2. Message `Logout berhasil.` appears. |

> Note: flash messages (`Registrasi berhasil.`, `Login berhasil.`, etc.) are kept in Indonesian because they are the literal strings shown in the UI and asserted by the test cases.

### Perintah Eksekusi

Menjalankan satu skenario tertentu:

```bash
php artisan dusk --filter=Test
```

Menjalankan seluruh skenario Dusk:

```bash
php artisan dusk
```
