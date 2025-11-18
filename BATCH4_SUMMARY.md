# BATCH 4 SUMMARY

## 📦 Files (4 pages)

1. **pages/manifest/umroh.php** - Manifest Jamaah Umroh (detail paket + 13 cols)
2. **pages/hotel/list.php** - Data Hotel (8 cols)
3. **pages/paket/keberangkatan_haji.php** - Keberangkatan Haji (10 cols)
4. **pages/paket/keberangkatan_umroh.php** - Keberangkatan Umroh (10 cols)
5. **database_update_batch4.sql** - Updates

## 🗄️ Database

### New:
- `tbl_hotel` (kode, nama, lokasi, kontak, email, rating, harga)

### Updated:
- `tbl_pendaftaran_jamaah` + habis_paspor, tipe_kamar, jumlah_pax
- `tbl_paket_keberangkatan` + rute_penerbangan

### Sample:
- 2 Hotel
- Updates existing data

## 🎨 Features

**Manifest Umroh:**
- Info box: Nama, Tanggal, Maskapai, Harga
- 3 stat cards: Total Transaksi, Sudah Bayar, Sisa (blue/green/orange)
- Table: 13 cols including paspor details
- Back button + Add button

**Data Hotel:**
- 8 cols: No, Kode, Nama, Lokasi, Kontak, Email, Rating, Harga, Action

**Keberangkatan Split:**
- Separate pages for Umroh & Haji
- 10 cols including Rute Penerbangan
- Active status badge

## 🔗 Routes

| URL | File |
|-----|------|
| ?mod=manifest&submod=umroh&id=X | manifest/umroh.php |
| ?mod=hotel&submod=list | hotel/list.php |
| ?mod=paket&submod=keberangkatan_haji | paket/keberangkatan_haji.php |
| ?mod=paket&submod=keberangkatan_umroh | paket/keberangkatan_umroh.php |

## 📊 Progress

**Total (Batch 1-4):**
- Pages: 19/50+ (38%)
- Tables: 17
- Files: 27

**Menu: 15/17 (88%)**

## Installation

```bash
mysql -u technocare -p zhafirah < database_update_batch4.sql
```

---
**Status: COMPLETE** ✅
