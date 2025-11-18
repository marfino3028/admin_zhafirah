# BATCH 6 SUMMARY

## 📦 Files (3 pages)

1. **pages/dokumen/izin_cuti.php** - Surat Izin Cuti (9 cols table)
2. **pages/agent/add.php** - Form Tambah Agent (with photo upload)
3. **pages/jamaah/add.php** - Form Tambah Jamaah (with photo upload)
4. **database_update_batch6.sql** - Updates
5. **uploads/** - Upload directories created

## 🗄️ Database

### New:
- `tbl_surat_izin_cuti` (id_jamaah,kode,tanggal_dokumen,tanggal_lahir,keberangkatan,kepulangan)

### Updated:
- `tbl_agent` + email,tempat_lahir,alamat,catatan,foto
- `tbl_pendaftaran_jamaah` + tempat_lahir,catatan,foto

### Sample:
- 1 Surat Izin Cuti

## 🎨 Features

**Surat Izin Cuti:**
- Table 9 cols same structure as Surat Rekomendasi
- Action: Edit,View,Delete

**Form Tambah Agent/Jamaah:**
- Left: Form inputs (Kode,NIK,Nama,Kontak,Email,dll)
- Right: Upload area with cloud icon
- Back button (orange) + Save button (purple gradient)
- Support photo upload
- Form validation with required fields

## 🔗 Routes

| URL | File |
|-----|------|
| ?mod=dokumen&submod=izin_cuti | dokumen/izin_cuti.php |
| ?mod=agent&submod=add | agent/add.php |
| ?mod=jamaah&submod=add | jamaah/add.php |

## 📊 Progress

**Total (Batch 1-6):**
- Pages: 25/50+ (50%)
- Tables: 20
- Files: 33
- Upload dirs ready

**Menu: 18/19 (95%)**

## Installation

```bash
mysql -u technocare -p zhafirah < database_update_batch6.sql
chmod 777 uploads/agent uploads/jamaah
```

---
**Status: COMPLETE** ✅
