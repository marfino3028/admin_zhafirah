# 🔄 DATABASE MIGRATION GUIDE
## Integrasi Portal Jamaah & Admin Panel

---

## 📋 PRE-MIGRATION CHECKLIST

**WAJIB dilakukan sebelum migrasi!**

- [ ] **Backup database lengkap**
  ```bash
  mysqldump -u root -p zhafirah > backup_before_migration_$(date +%Y%m%d_%H%M%S).sql
  ```

- [ ] **Test di development/staging dulu**
  - JANGAN langsung di production!
  - Buat database testing: `zhafirah_test`
  
- [ ] **Matikan aplikasi sementara**
  - Portal jamaah: Maintenance mode
  - Admin panel: Maintenance mode
  
- [ ] **Siapkan rollback plan**
  - File `rollback_script.sql` sudah ada
  - Pastikan backup accessible

- [ ] **Koordinasi tim**
  - Notify semua user akan ada maintenance
  - Siapkan tim support untuk monitor

---

## 🚀 CARA EKSEKUSI MIGRASI

### STEP 1: Backup Database
```bash
# Login ke server
ssh user@your-server

# Masuk ke direktori backup
cd /path/to/backups

# Backup database
mysqldump -u root -p zhafirah > backup_pre_migration_$(date +%Y%m%d_%H%M%S).sql

# Verify backup
ls -lh backup_pre_migration*
```

### STEP 2: Test di Development
```bash
# Create test database
mysql -u root -p -e "CREATE DATABASE zhafirah_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Restore current database to test
mysql -u root -p zhafirah_test < backup_pre_migration_*.sql

# Run migration script on test database
mysql -u root -p zhafirah_test < migration_script.sql

# Check results
mysql -u root -p zhafirah_test -e "
SELECT 'Users' as 'Table', COUNT(*) as 'Count' FROM users
UNION ALL SELECT 'Bookings', COUNT(*) FROM bookings
UNION ALL SELECT 'Payments', COUNT(*) FROM payments
UNION ALL SELECT 'Packages', COUNT(*) FROM packages;
"
```

### STEP 3: Jika Test OK, Run di Production
```bash
# Run migration di production
mysql -u root -p zhafirah < migration_script.sql

# Script akan berhenti di akhir untuk review
# Anda akan melihat hasil migration
```

### STEP 4: Review & Commit
```sql
-- Di dalam MySQL prompt
USE zhafirah;

-- Review hasil migrasi
SELECT * FROM users LIMIT 5;
SELECT * FROM bookings LIMIT 5;
SELECT * FROM payments LIMIT 5;
SELECT * FROM packages LIMIT 5;

-- Jika semua OK:
COMMIT;

-- Jika ada masalah:
ROLLBACK;
```

---

## ⚠️ ROLLBACK (Jika Ada Masalah)

```bash
# Jika migrasi gagal atau ada bug kritis:
mysql -u root -p zhafirah < rollback_script.sql

# Atau restore dari backup manual:
mysql -u root -p zhafirah < backup_pre_migration_YYYYMMDD_HHMMSS.sql
```

---

## 🔍 POST-MIGRATION VERIFICATION

### 1. Cek Data Integrity
```sql
-- Cek apakah ada booking tanpa user
SELECT COUNT(*) as orphan_bookings
FROM bookings b
LEFT JOIN users u ON b.user_id = u.id
WHERE u.id IS NULL;

-- Cek apakah ada payment tanpa booking
SELECT COUNT(*) as orphan_payments
FROM payments p
LEFT JOIN bookings b ON p.booking_id = b.id
WHERE b.id IS NULL;

-- Cek apakah quota package benar
SELECT 
    p.package_name,
    p.quota,
    p.remaining_quota,
    COUNT(b.id) as total_bookings
FROM packages p
LEFT JOIN bookings b ON p.id = b.package_id AND b.status IN ('pending','confirmed','paid')
GROUP BY p.id;
```

### 2. Test Aplikasi

#### A. Test Portal Jamaah
- [ ] Login user existing ✅
- [ ] Lihat paket ✅
- [ ] Buat booking baru ✅
- [ ] Lihat history booking ✅
- [ ] Lihat history pembayaran ✅

#### B. Test Admin Panel
- [ ] Login admin ✅
- [ ] Lihat list jamaah (dari `users`) ✅
- [ ] Lihat list booking (dari `bookings`) ✅
- [ ] Lihat list pembayaran (dari `payments`) ✅
- [ ] Lihat list paket (dari `packages`) ✅
- [ ] Verifikasi pembayaran ✅
- [ ] Generate laporan ✅

### 3. Monitor Logs
```bash
# Monitor error logs
tail -f /var/log/apache2/error.log  # atau nginx
tail -f /path/to/application/logs/error.log

# Monitor MySQL slow queries
tail -f /var/log/mysql/slow-query.log
```

---

## 📊 EXPECTED RESULTS

Setelah migrasi berhasil, struktur database akan seperti ini:

```
┌─────────────────────────────────────────┐
│  UNIFIED DATABASE STRUCTURE             │
├─────────────────────────────────────────┤
│                                         │
│  users (Portal + Admin)                 │
│   ├─ Data jamaah dari portal            │
│   └─ Data jamaah dari admin panel       │
│                                         │
│  packages (Portal + Admin)              │
│   └─ Paket Umroh & Haji                 │
│                                         │
│  bookings (Portal + Admin)              │
│   ├─ Booking dari portal                │
│   └─ Pendaftaran dari admin panel       │
│                                         │
│  payments (Portal + Admin)              │
│   ├─ Pembayaran via portal/Xendit       │
│   └─ Pembayaran manual via admin        │
│                                         │
│  tbl_pemasukan_umum (Admin Only)        │
│   └─ Pemasukan non-booking              │
│                                         │
│  v_all_pemasukan (VIEW)                 │
│   └─ Gabungan semua pemasukan           │
│                                         │
└─────────────────────────────────────────┘
```

---

## 🛠️ TROUBLESHOOTING

### Problem 1: Foreign Key Constraint Error
```sql
-- Disable foreign key checks temporarily
SET FOREIGN_KEY_CHECKS=0;
-- Run migration again
SOURCE migration_script.sql;
SET FOREIGN_KEY_CHECKS=1;
```

### Problem 2: Duplicate Entry Error
```sql
-- Check for duplicates
SELECT booking_code, COUNT(*) 
FROM bookings 
GROUP BY booking_code 
HAVING COUNT(*) > 1;

-- Remove duplicates manually before migration
```

### Problem 3: Migration Takes Too Long
```sql
-- Run migration in smaller batches
-- Edit migration_script.sql and add LIMIT to INSERT statements
-- Example:
INSERT INTO bookings (...) 
SELECT ... FROM tbl_pendaftaran_jamaah
LIMIT 1000;  -- Process 1000 at a time
```

---

## 📞 SUPPORT

**Jika menemukan masalah:**

1. **JANGAN PANIC!** 
2. **JANGAN RUN query random!**
3. Screenshot error message
4. Run: `ROLLBACK;` jika masih dalam transaction
5. Restore dari backup jika sudah COMMIT
6. Hubungi developer team

**Emergency Contact:**
- Developer: [Your Contact]
- Database Admin: [Your Contact]

---

## ✅ SUCCESS INDICATORS

Migration dianggap **BERHASIL** jika:

- ✅ Semua data jamaah, booking, payment ter-migrasi
- ✅ Tidak ada data duplikat
- ✅ Portal jamaah bisa buat booking baru
- ✅ Admin bisa lihat booking dari portal
- ✅ Payment verification di admin berfungsi
- ✅ Laporan keuangan mencakup semua transaksi
- ✅ Tidak ada error di aplikasi
- ✅ Performance masih OK

---

## 📝 NOTES

1. **Migration bersifat ONE-WAY**
   - Setelah di-COMMIT, tidak bisa auto-rollback
   - Hanya bisa restore dari backup
   
2. **Old tables tidak di-DROP**
   - Di-rename jadi `_deprecated_*`
   - Bisa di-drop setelah 30 hari jika semua OK
   
3. **tbl_pemasukan_umum tetap ada**
   - Digunakan untuk pemasukan non-booking
   - Ter-integrasi via VIEW `v_all_pemasukan`

4. **Testing WAJIB di development dulu!**
   - JANGAN langsung production
   - Minimal test 1-2 minggu di staging

---

**Last Updated:** 2025-11-20  
**Version:** 1.0  
**Status:** Ready for Testing
