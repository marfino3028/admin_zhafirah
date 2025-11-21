# DATABASE MIGRATION PLAN
## Integrasi Portal Jamaah & Admin Panel

### MASALAH SAAT INI
Portal Jamaah dan Admin Panel menggunakan tabel database yang **BERBEDA** untuk fungsi yang **SAMA**:

| Fungsi | Portal Jamaah | Admin Panel (OLD) | Status |
|--------|---------------|-------------------|---------|
| User/Jamaah | `users` | Manual entry | ❌ Tidak terintegrasi |
| Booking/Pendaftaran | `bookings` | `tbl_pendaftaran_jamaah` | ❌ DUPLIKAT |
| Pembayaran | `payments` | `tbl_pembayaran` | ❌ DUPLIKAT |
| Paket | `packages` | `tbl_paket_keberangkatan` | ❌ DUPLIKAT |
| Pemasukan | - | `tbl_pemasukan_umum` | ⚠️ Terpisah |

---

## SOLUSI: UNIFIED DATABASE STRUCTURE

### 1. TABEL UTAMA (Portal + Admin)

#### A. `users` - Master Data Jamaah
```sql
-- Sudah ada, perlu tambah kolom untuk admin panel
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `admin_notes` TEXT NULL;
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `referral_source` VARCHAR(100) NULL;
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `emergency_contact` VARCHAR(100) NULL;
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `emergency_phone` VARCHAR(20) NULL;
```

#### B. `packages` - Master Data Paket (Umroh & Haji)
```sql
-- Sudah ada, rename/standardisasi nama kolom jika perlu
-- Kolom existing: id, package_code, package_name, package_type, price, dll
```

#### C. `bookings` - Data Pendaftaran/Booking
```sql
-- Sudah ada, tambah kolom untuk keperluan admin
ALTER TABLE `bookings` ADD COLUMN IF NOT EXISTS `jamaah_type` ENUM('individu','group') DEFAULT 'individu';
ALTER TABLE `bookings` ADD COLUMN IF NOT EXISTS `room_type` VARCHAR(50) NULL;
ALTER TABLE `bookings` ADD COLUMN IF NOT EXISTS `special_requests` TEXT NULL;
ALTER TABLE `bookings` ADD COLUMN IF NOT EXISTS `approved_by` INT NULL COMMENT 'ID admin yang approve';
ALTER TABLE `bookings` ADD COLUMN IF NOT EXISTS `approved_at` TIMESTAMP NULL;
```

#### D. `payments` - Data Pembayaran
```sql
-- Cek struktur existing
-- Perlu pastikan ada kolom untuk tracking pembayaran bertahap
ALTER TABLE `payments` ADD COLUMN IF NOT EXISTS `payment_sequence` INT DEFAULT 1 COMMENT 'Pembayaran ke-X';
ALTER TABLE `payments` ADD COLUMN IF NOT EXISTS `payment_method` ENUM('transfer','cash','card','ewallet','va') DEFAULT 'transfer';
ALTER TABLE `payments` ADD COLUMN IF NOT EXISTS `verified_by` INT NULL COMMENT 'ID admin yang verify';
ALTER TABLE `payments` ADD COLUMN IF NOT EXISTS `verified_at` TIMESTAMP NULL;
```

---

### 2. MIGRATION SCRIPT

#### STEP 1: Backup Data Lama
```sql
-- Backup existing admin tables
CREATE TABLE IF NOT EXISTS tbl_pendaftaran_jamaah_backup AS SELECT * FROM tbl_pendaftaran_jamaah;
CREATE TABLE IF NOT EXISTS tbl_pembayaran_backup AS SELECT * FROM tbl_pembayaran;
CREATE TABLE IF NOT EXISTS tbl_paket_keberangkatan_backup AS SELECT * FROM tbl_paket_keberangkatan;
CREATE TABLE IF NOT EXISTS tbl_pemasukan_umum_backup AS SELECT * FROM tbl_pemasukan_umum;
```

#### STEP 2: Migrasi Data ke Tabel Unified

**A. Migrasi Paket ke `packages`**
```sql
INSERT INTO packages (
    package_code,
    package_name,
    package_type,
    price,
    duration_days,
    departure_date,
    quota,
    remaining_quota,
    includes,
    excludes,
    hotel_makkah,
    hotel_madinah,
    airline,
    status,
    created_at
)
SELECT 
    kode_paket,
    nama_paket,
    LOWER(jenis_paket), -- 'umroh' atau 'haji'
    harga_paket,
    lama_hari,
    tanggal_keberangkatan,
    kuota_jamaah,
    kuota_jamaah - (SELECT COUNT(*) FROM tbl_pendaftaran_jamaah WHERE id_paket = tp.id_paket),
    fasilitas,
    NULL,
    hotel_makkah,
    hotel_madinah,
    maskapai,
    IF(status = 'Active', 'active', 'inactive'),
    created_at
FROM tbl_paket_keberangkatan tp
WHERE kode_paket NOT IN (SELECT package_code FROM packages);
```

**B. Migrasi Jamaah ke `users`**
```sql
-- Untuk jamaah yang sudah pernah daftar via admin tapi belum punya akun portal
INSERT INTO users (
    full_name,
    email,
    phone,
    whatsapp,
    date_of_birth,
    gender,
    address,
    city,
    province,
    postal_code,
    ktp_number,
    passport_number,
    passport_expiry,
    is_active,
    email_verified,
    created_at
)
SELECT DISTINCT
    nama_jamaah,
    CONCAT('jamaah_', id_jamaah, '@zhafirah.local'), -- temporary email
    no_hp,
    no_hp, -- whatsapp sama dengan no_hp
    tanggal_lahir,
    jenis_kelamin,
    alamat_lengkap,
    kota,
    provinsi,
    kode_pos,
    no_ktp,
    no_paspor,
    tanggal_expired_paspor,
    1,
    0, -- belum verified karena email temporary
    created_at
FROM tbl_pendaftaran_jamaah pj
WHERE pj.email NOT IN (SELECT email FROM users)
  AND pj.no_hp NOT IN (SELECT phone FROM users);
```

**C. Migrasi Pendaftaran ke `bookings`**
```sql
INSERT INTO bookings (
    booking_code,
    user_id,
    package_id,
    total_amount,
    status,
    payment_status,
    notes,
    jamaah_type,
    room_type,
    created_at,
    updated_at
)
SELECT 
    pj.kode_pendaftaran,
    (SELECT id FROM users WHERE phone = pj.no_hp LIMIT 1), -- link ke user
    (SELECT id FROM packages WHERE package_code = pk.kode_paket LIMIT 1), -- link ke package
    pk.harga_paket,
    CASE 
        WHEN pj.status = 'Approved' THEN 'confirmed'
        WHEN pj.status = 'Pending' THEN 'pending'
        ELSE 'cancelled'
    END,
    CASE 
        WHEN (SELECT SUM(jumlah_bayar) FROM tbl_pembayaran WHERE id_pendaftaran = pj.id_pendaftaran) >= pk.harga_paket THEN 'paid'
        WHEN (SELECT COUNT(*) FROM tbl_pembayaran WHERE id_pendaftaran = pj.id_pendaftaran) > 0 THEN 'pending'
        ELSE 'unpaid'
    END,
    pj.catatan,
    pj.jenis_pendaftaran, -- 'individu' atau 'group'
    pj.jenis_kamar,
    pj.created_at,
    pj.updated_at
FROM tbl_pendaftaran_jamaah pj
LEFT JOIN tbl_paket_keberangkatan pk ON pj.id_paket = pk.id_paket
WHERE pj.kode_pendaftaran NOT IN (SELECT booking_code FROM bookings);
```

**D. Migrasi Pembayaran ke `payments`**
```sql
INSERT INTO payments (
    booking_id,
    payment_code,
    payment_method,
    amount,
    payment_date,
    payment_status,
    payment_sequence,
    payment_proof,
    xendit_invoice_id,
    xendit_payment_method,
    xendit_payment_channel,
    notes,
    verified_by,
    verified_at,
    created_at
)
SELECT 
    (SELECT id FROM bookings WHERE booking_code = pj.kode_pendaftaran LIMIT 1), -- link ke booking
    pb.kode_pembayaran,
    pb.metode_pembayaran, -- 'transfer', 'cash', dll
    pb.jumlah_bayar,
    pb.tanggal_bayar,
    CASE 
        WHEN pb.status = 'Verified' THEN 'success'
        WHEN pb.status = 'Pending' THEN 'pending'
        ELSE 'failed'
    END,
    pb.pembayaran_ke, -- sequence pembayaran
    pb.bukti_transfer,
    NULL, -- xendit_invoice_id (untuk pembayaran lama tidak ada)
    NULL, -- xendit_payment_method
    NULL, -- xendit_payment_channel
    pb.catatan,
    pb.verified_by_admin,
    pb.verified_at,
    pb.created_at
FROM tbl_pembayaran pb
LEFT JOIN tbl_pendaftaran_jamaah pj ON pb.id_pendaftaran = pj.id_pendaftaran
WHERE pb.kode_pembayaran NOT IN (SELECT payment_code FROM payments WHERE payment_code IS NOT NULL);
```

**E. Handle Pemasukan Umum**
```sql
-- Pemasukan umum tetap di tabel terpisah ATAU
-- Bisa dimasukkan ke payments dengan booking_id = NULL untuk transaksi non-booking

-- OPSI 1: Tetap pisah tabel (RECOMMENDED)
-- Biarkan tbl_pemasukan_umum ada, tapi buat view gabungan untuk laporan

CREATE OR REPLACE VIEW v_all_pemasukan AS
SELECT 
    'booking' as source_type,
    p.id,
    b.booking_code as reference_code,
    p.amount,
    p.payment_date as transaction_date,
    p.payment_method,
    p.payment_status as status,
    CONCAT('Pembayaran booking ', b.booking_code) as description,
    p.created_at
FROM payments p
JOIN bookings b ON p.booking_id = b.id
WHERE p.payment_status = 'success'

UNION ALL

SELECT 
    'general' as source_type,
    pu.id_pemasukan as id,
    pu.kode_pemasukan as reference_code,
    pu.jumlah as amount,
    pu.tanggal_pemasukan as transaction_date,
    'other' as payment_method,
    'success' as status,
    pu.keterangan as description,
    pu.created_at
FROM tbl_pemasukan_umum pu;
```

#### STEP 3: Drop/Rename Old Tables
```sql
-- Setelah yakin data sudah migrasi dengan benar
-- RENAME tabel lama (jangan langsung DROP untuk safety)

RENAME TABLE tbl_pendaftaran_jamaah TO _deprecated_tbl_pendaftaran_jamaah;
RENAME TABLE tbl_pembayaran TO _deprecated_tbl_pembayaran;
RENAME TABLE tbl_paket_keberangkatan TO _deprecated_tbl_paket_keberangkatan;
-- tbl_pemasukan_umum BIARKAN (optional: bisa tetap digunakan untuk pemasukan non-booking)
```

---

### 3. UPDATE KODE ADMIN PANEL

#### File yang perlu diupdate:

**A. Pendaftaran Jamaah**
```
admin_zhafirah_umroh_system/pages/jamaah/
- list.php → Query dari bookings JOIN users JOIN packages
- add.php → Insert ke bookings (otomatis create user jika belum ada)
- edit.php → Update bookings
```

**B. Pembayaran**
```
admin_zhafirah_umroh_system/pages/pembayaran/
- list.php → Query dari payments JOIN bookings
- add.php → Insert ke payments
- verify.php → Update payments set verified_by, verified_at
```

**C. Paket**
```
admin_zhafirah_umroh_system/pages/paket/
- list.php → Query dari packages
- add.php → Insert ke packages
- edit.php → Update packages
```

**D. Laporan**
```
admin_zhafirah_umroh_system/pages/laporan/
- Gunakan VIEW v_all_pemasukan untuk laporan keuangan gabungan
```

---

### 4. EXECUTION PLAN

#### Phase 1: Preparation (1-2 hari)
- [ ] Backup database lengkap
- [ ] Test migration script di database development
- [ ] Verifikasi data hasil migrasi

#### Phase 2: Migration (1 hari)
- [ ] Run migration script di production
- [ ] Verifikasi data integrity
- [ ] Test CRUD operations

#### Phase 3: Code Update (2-3 hari)
- [ ] Update admin panel queries
- [ ] Test semua fitur admin
- [ ] Test integrasi portal-admin

#### Phase 4: Testing & Rollout (1-2 hari)
- [ ] UAT (User Acceptance Testing)
- [ ] Fix bugs jika ada
- [ ] Go live
- [ ] Monitor 24 jam pertama

---

### 5. ROLLBACK PLAN

Jika ada masalah:
```sql
-- Restore dari backup
DROP TABLE users;
DROP TABLE bookings;
DROP TABLE payments;
DROP TABLE packages;

-- Rename old tables back
RENAME TABLE _deprecated_tbl_pendaftaran_jamaah TO tbl_pendaftaran_jamaah;
RENAME TABLE _deprecated_tbl_pembayaran TO tbl_pembayaran;
RENAME TABLE _deprecated_tbl_paket_keberangkatan TO tbl_paket_keberangkatan;

-- Restore from backup file
SOURCE backup_before_migration.sql;
```

---

### 6. POST-MIGRATION CHECKLIST

- [ ] Data jamaah dari portal & admin bisa dilihat di satu tempat
- [ ] Booking baru dari portal muncul di admin
- [ ] Pembayaran dari portal bisa diverifikasi di admin
- [ ] Laporan keuangan mencakup semua transaksi (portal + admin)
- [ ] Tidak ada data duplikat
- [ ] Semua foreign key constraint jalan
- [ ] Performance query masih optimal

---

## CONTACT & SUPPORT

Jika ada pertanyaan atau butuh bantuan:
- Create issue di repository
- Konsultasi dengan Tim Developer

**Status**: 📋 DRAFT - Menunggu Review & Approval
**Last Updated**: 2025-11-20
