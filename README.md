# Admin Panel Zhafirah Umroh System

Admin panel untuk mengelola sistem Wisata Haromain Tour & Travel dengan PHP Native.

## Struktur File

```
admin_zhafirah_umroh_system/
├── 3rdparty/
│   ├── engine.php          # Database connection
│   └── parser.php
├── pages/
│   ├── depan.php           # Dashboard home
│   ├── paket/
│   │   └── keberangkatan.php   # Data paket keberangkatan
│   └── pengeluaran/
│       ├── umum.php        # Data pengeluaran umum
│       └── umroh.php       # Data pengeluaran umroh
├── css/
├── js/
├── images/
├── vendor/
├── header.php              # Header template
├── footer.php              # Footer template
├── login.php               # Login page
├── index.php               # Main router
└── database_structure.sql  # Database schema
```

## Database Configuration

File: `/Users/user/Documents/freelance/zhafirah_umroh_system/config/database.php`
Database: `zhafirah`

### Koneksi Database di engine.php
```php
$db = new database("zhafirah", "Mahameru2025!", "technocare", "127.0.0.1");
```

## Default Login

- **Email**: admin@wisataharomain.com
- **Password**: admin123

## Fitur yang Sudah Dibuat

### 1. Login Page (login.php)
- Modern login design
- Email & password authentication
- Session management

### 2. Dashboard Home (pages/depan.php)
Menampilkan:
- Total Transaksi Umroh & Haji
- Sudah Pembayaran Umroh & Haji
- Sisa Tagihan Umroh & Haji
- Total Jamaah Umroh & Haji
- Data Tabungan (Total & Jumlah Jamaah)

### 3. Data Paket Keberangkatan (pages/paket/keberangkatan.php)
Menampilkan 2 tabel:
- Data Paket Keberangkatan Umroh
- Data Paket Keberangkatan Haji

Kolom: No, Kode, Nama, Tanggal, Lokasi, Pesawat/Maskapai, Jumlah Hari, Kuota, Terisi, Sisa, Status

### 4. Data Pengeluaran Umum (pages/pengeluaran/umum.php)
Fitur:
- Filter periode bulanan
- Total pengeluaran umum (card)
- Tabel data pengeluaran
- Button: Add, Excel, Print, Reset, Reload

### 5. Pengeluaran Umroh (pages/pengeluaran/umroh.php)
Fitur:
- Filter berdasarkan nama keberangkatan umroh
- Total pengeluaran umroh (card)
- Tabel data pengeluaran per keberangkatan
- Button: Add, Excel, Print, Reset, Reload

## Routing System

File: `index.php`

Format URL: `index.php?mod=module&submod=page`

Contoh:
- Dashboard: `index.php` atau `index.php?mod=`
- Data Keberangkatan: `index.php?mod=paket&submod=keberangkatan`
- Pengeluaran Umum: `index.php?mod=pengeluaran&submod=umum`
- Pengeluaran Umroh: `index.php?mod=pengeluaran&submod=umroh`

## Database Tables

### Tabel Utama:
1. `tbl_user` - User accounts
2. `tbl_maskapai` - Airlines
3. `tbl_paket_keberangkatan` - Travel packages
4. `tbl_pendaftaran_jamaah` - Pilgrim registration
5. `tbl_pembayaran` - Payments
6. `tbl_tabungan` - Savings
7. `tbl_pengeluaran_umum` - General expenses
8. `tbl_pengeluaran_umroh` - Umroh expenses

### Import Database:
```bash
mysql -u technocare -p zhafirah < database_structure.sql
```

## Styling

- Bootstrap 3/4 (dari vendor/theme)
- Font Awesome 5.15.4
- Custom CSS dengan gradient modern
- Responsive design
- Card-based layout

## Color Scheme

- Primary: `#667eea` → `#764ba2` (gradient)
- Success: `#11998e` → `#38ef7d` (gradient)
- Danger: `#ee0979` → `#ff6a00` (gradient)
- Dark: `#2c3e50`
- Light: `#f5f6fa`

## Menu Sidebar

Menu Dashboard:
- Home

Menu Travel:
- Data Pendaftaran
- Data Jamaah
- Data Agent
- Data Karyawan
- Data Paket
- Data Keberangkatan ✓
- Data Pembayaran
- Data Pengeluaran ✓
- Pengeluaran Umroh ✓
- Pengeluaran Haji
- Data Pemasukan
- Data Laporan
- Data Dokumen
- Data Maskapai
- Data Hotel

✓ = Sudah dibuat

## Next Steps

Fitur yang perlu ditambahkan:
1. CRUD operations untuk semua modul
2. Export Excel & Print
3. Data validation
4. File upload untuk dokumen
5. Laporan & Analytics
6. User management
7. Role & permissions

## Notes

- PHP Native (tidak menggunakan framework)
- Database connection menggunakan `mysql_*` di engine.php
- Session untuk authentication
- Modular structure dengan routing

## Support

Developed by PT Techno Healthcare Indonesia
