# 🌱 AgroMart — Smart Farming Store

> Tugas Akhir Pemrograman Web (PWEB)  
> **Hafizah Dini Azahara** — NIM 242410101011  
> Dosen Pengampu: **Shynta Ayu Dwi Darmawan S.Kom, MMSI**

---

## 📌 Deskripsi Aplikasi

**AgroMart** adalah platform digital penjualan pupuk modern yang dirancang untuk membantu petani mendapatkan produk berkualitas dengan pengalaman berbelanja yang cepat, aman, dan terpercaya. Aplikasi ini menyediakan dua peran pengguna yaitu **Admin** dan **Customer** dengan fitur-fitur yang lengkap untuk mendukung kegiatan jual beli pupuk secara online.

🔗 **Live Demo:** [https://pwebtugas-akhir-production.up.railway.app](https://pwebtugas-akhir-production.up.railway.app)

---

## 🛠️ Teknologi yang Digunakan

| Teknologi | Versi |
|-----------|-------|
| PHP | 8.3.30 |
| Laravel | 13.6.0 |
| MySQL | 8.4.3 |
| Tailwind CSS | 3.x |
| Railway | (Deployment) |

---

## ✨ Fitur Aplikasi

### 👨‍💼 Fitur Admin

| No | Fitur | Keterangan |
|----|-------|------------|
| 1 | **Login** | Autentikasi admin dengan email dan password |
| 2 | **Dashboard** | Ringkasan data produk, pesanan, pelanggan, pendapatan, dan cuaca real-time |
| 3 | **Profil** | Melihat dan mengubah data profil admin |
| 4 | **Katalog Produk** | CRUD produk pupuk (tambah, lihat, edit, hapus) dengan live search |
| 5 | **Pesanan Customer** | Melihat daftar pesanan dan mengubah status pesanan |
| 6 | **Laporan Penjualan** | Rekap data transaksi penjualan |
| 7 | **Chat** | Membalas pesan dari customer secara real-time |
| 8 | **Notifikasi** | Notifikasi pesanan baru dan stok menipis |
| 9 | **Pengaturan** | Kustomisasi tema (light/dark) dan ukuran teks |
| 10 | **Logout** | Mengakhiri sesi admin |

### 🧑‍🌾 Fitur Customer

| No | Fitur | Keterangan |
|----|-------|------------|
| 1 | **Registrasi** | Pendaftaran akun baru |
| 2 | **Login** | Autentikasi customer |
| 3 | **Dashboard** | Ringkasan pesanan, keranjang, pengeluaran, cuaca, dan tips pertanian |
| 4 | **Katalog Produk** | Melihat produk dengan fitur live search real-time |
| 5 | **Keranjang** | Tambah, lihat, dan hapus produk di keranjang |
| 6 | **Pesanan** | Melakukan pemesanan dan melihat riwayat pesanan |
| 7 | **Chat** | Menghubungi admin secara langsung |
| 8 | **Notifikasi** | Notifikasi pembaruan status pesanan |
| 9 | **Pengaturan** | Kustomisasi tema dan ukuran teks |
| 10 | **Logout** | Mengakhiri sesi customer |

---

## 🗄️ Struktur Database

| Tabel | Keterangan |
|-------|------------|
| `users` | Data pengguna (admin & customer) |
| `pupuks` | Data produk pupuk |
| `carts` | Keranjang belanja customer |
| `transactions` | Data transaksi/pesanan |
| `transaction_items` | Detail item per transaksi |
| `chats` | Sesi percakapan admin-customer |
| `messages` | Isi pesan chat |
| `notifications` | Data notifikasi pengguna |
| `pelanggans` | Data pelanggan lama |
| `transaksi` | Data transaksi lama |

---

## ⚙️ Cara Instalasi (Local)

### Prasyarat
- PHP >= 8.3
- Composer
- MySQL
- Laragon / XAMPP

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/dinazhra/PWEB_Tugas-Akhir.git
cd PWEB_Tugas-Akhir
```

**2. Install dependencies**
```bash
composer install
npm install
```

**3. Konfigurasi environment**
```bash
cp .env.example .env
php artisan key:generate
```

**4. Atur koneksi database di file `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pupuk_db
DB_USERNAME=root
DB_PASSWORD=
```

**5. Jalankan migrasi database**
```bash
php artisan migrate
```

**6. Buat storage link untuk foto produk**
```bash
php artisan storage:link
```

**7. Jalankan aplikasi**
```bash
php artisan serve
```

Akses aplikasi di: `http://127.0.0.1:8000`

---

## 🔑 Akun Default

| Role | Email | Password |
|------|-------|----------|
| Admin | adminpupuk@mail.com | *(sesuai yang didaftarkan)* |
| Customer | *(daftar melalui halaman register)* | - |

---

## 📡 API yang Digunakan

| API | Endpoint | Keterangan |
|-----|----------|------------|
| Cuaca | `https://wttr.in/Jember?format=j1` | Data cuaca real-time kota Jember |
| Live Search | `/pupuk-search?search=keyword` | Pencarian produk real-time (internal) |
| Chat Poll | `/chat/poll?last_id=n` | Polling pesan chat baru (internal) |
| Settings | `/settings/save` | Simpan preferensi tampilan (internal) |

---

## 📁 Struktur Folder Utama

```
pupuk-app/
├── app/
│   ├── Http/Controllers/     # Controller aplikasi
│   └── Models/               # Model Eloquent
├── database/
│   └── migrations/           # File migrasi database
├── public/                   # Asset publik
├── resources/
│   └── views/                # Blade template
│       ├── auth/             # Halaman login & register
│       ├── pupuk/            # Halaman katalog produk
│       ├── cart/             # Halaman keranjang
│       ├── customer/         # Dashboard customer
│       ├── chat/             # Halaman chat
│       └── partials/         # Komponen navbar, footer
├── routes/
│   └── web.php               # Definisi route
└── .env                      # Konfigurasi environment
```

---

## 👩‍💻 Author

**Hafizah Dini Azahara**  
NIM: 242410101011  
Program Studi Sistem Informasi  
Universitas Jember

---

*Tugas Akhir Mata Kuliah Pemrograman Web — 2026*
