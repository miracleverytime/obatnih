# 💊 ObatNih - Sistem E-Commerce Obat

ObatNih adalah sebuah sistem e-commerce berbasis web yang dirancang untuk memudahkan pengguna dalam melakukan pencarian, pembelian, serta pengelolaan data obat secara digital. Sistem ini juga menyediakan antarmuka khusus untuk admin dan apoteker dalam mengelola produk, validasi, dan laporan penjualan.

## 🚀 Fitur Utama

### 🔓 Autentikasi & Hak Akses

- **Login & Register** untuk user
- Role-based login (Admin, Apoteker, User)
- Proteksi URL berdasarkan role login

### 🧾 Fitur Pengguna (User)

- Lihat daftar obat lengkap dengan gambar & deskripsi
- Cari dan lihat detail produk
- Tambahkan ke keranjang
- Konsultasi dengan apoteker

### ⚙️ Fitur Admin

- Dashboard Admin
- Tambah, edit, hapus obat
- Upload gambar obat
- Laporan penjualan
- Kelola data staff (admin & apoteker)

### 🧪 Fitur Apoteker

- Validasi data dan proses pesanan
- Konsultasi atau bantuan

---

## 🛠️ Teknologi yang Digunakan

- **CodeIgniter 4** - Framework PHP
- **Bootstrap 5** - Desain responsif
- **MySQL** - Basis data
- **Font Awesome** - Ikon modern
- **jQuery** - Untuk validasi form & interaksi
- **SweetAlert (opsional)** - Notifikasi elegan

---

## 📁 Struktur Folder Penting

```
/app
  /Controllers
  /Models
  /Views
/public
  /assets
    /css
    /js
    /gambar
```

---

## ⚙️ Cara Menjalankan

1. Clone repo ini
2. Buat database `obatnih` lalu import file `.sql`
3. Konfigurasi `.env`:
   ```bash
   database.default.hostname = localhost
   database.default.database = obatnih
   database.default.username = root
   database.default.password =
   ```
4. Jalankan:
   ```bash
   php spark serve
   ```
5. Akses di browser: `http://localhost:8080`

---

PAKAI PHP VERSI 8.1.25 JIKA TERJADI ERROR MYSQLI_RESULT

## ✅ Lisensi

Open-source untuk keperluan edukasi.
