# BATCH 5 SUMMARY

## 📦 Files (3 pages)

1. **pages/pemasukan/umum.php** - Pemasukan Umum (filter+card+6 cols)
2. **pages/paket/haji.php** - Data Paket Haji (foto+12 cols)
3. **pages/paket/umroh.php** - Data Paket Umroh (foto+12 cols)
4. **database_update_batch5.sql** - Updates

## 🗄️ Database

### New:
- `tbl_pemasukan_umum` (kode,tanggal,jenis,nama,jumlah)
- `tbl_paket` (kode,nama,jenis,tanggal,hari,maskapai,lokasi,harga,kuota,foto,status)

### Sample:
- 2 Pemasukan
- 4 Paket (2 haji, 2 umroh)

## 🎨 Features

**Pemasukan Umum:**
- Filter periode bulanan (month input)
- Green stat card (total)
- Table 6 cols: No,Tanggal,Kode,Jenis,Nama,Jumlah,Action

**Data Paket Haji/Umroh:**
- Foto Brosur column (image preview)
- 12 cols including foto,status,action
- Active status badge (green)
- Same structure for both

## 🔗 Routes

| URL | File |
|-----|------|
| ?mod=pemasukan&submod=umum | pemasukan/umum.php |
| ?mod=paket&submod=haji | paket/haji.php |
| ?mod=paket&submod=umroh | paket/umroh.php |

## 📊 Progress

**Total (Batch 1-5):**
- Pages: 22/50+ (44%)
- Tables: 19
- Files: 30

**Menu: 17/19 (89%)**

## Installation

```bash
mysql -u technocare -p zhafirah < database_update_batch5.sql
```

---
**Status: COMPLETE** ✅
