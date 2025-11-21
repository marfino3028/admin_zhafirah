-- ============================================
-- ROLLBACK SCRIPT: Restore to Pre-Migration State
-- Database: zhafirah
-- Use this ONLY if migration fails
-- ============================================

SET autocommit = 0;
START TRANSACTION;

SELECT '⚠️ ROLLBACK STARTED - Restoring to pre-migration state...' as 'Status';

-- ============================================
-- STEP 1: Restore from backup tables
-- ============================================

-- Drop current tables (yang sudah di-migrate)
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS packages;

-- Restore from backup
CREATE TABLE users AS SELECT * FROM _backup_users;
CREATE TABLE bookings AS SELECT * FROM _backup_bookings;
CREATE TABLE payments AS SELECT * FROM _backup_payments;
CREATE TABLE packages AS SELECT * FROM _backup_packages;

-- Restore indexes and constraints
ALTER TABLE users ADD PRIMARY KEY (id);
ALTER TABLE bookings ADD PRIMARY KEY (id);
ALTER TABLE payments ADD PRIMARY KEY (id);
ALTER TABLE packages ADD PRIMARY KEY (id);

-- ============================================
-- STEP 2: Restore old admin tables
-- ============================================

-- Drop deprecated tables
DROP TABLE IF EXISTS _deprecated_tbl_pendaftaran_jamaah;
DROP TABLE IF EXISTS _deprecated_tbl_pembayaran;
DROP TABLE IF EXISTS _deprecated_tbl_paket_keberangkatan;

-- Restore from backup
CREATE TABLE tbl_pendaftaran_jamaah AS SELECT * FROM _backup_tbl_pendaftaran_jamaah;
CREATE TABLE tbl_pembayaran AS SELECT * FROM _backup_tbl_pembayaran;
CREATE TABLE tbl_paket_keberangkatan AS SELECT * FROM _backup_tbl_paket_keberangkatan;

SELECT '✅ Tables restored from backup' as 'Status';

-- ============================================
-- STEP 3: Drop unified view
-- ============================================

DROP VIEW IF EXISTS v_all_pemasukan;

SELECT '✅ Unified view removed' as 'Status';

-- ============================================
-- STEP 4: Verify restoration
-- ============================================

SELECT 
    'tbl_pendaftaran_jamaah' as 'Table',
    COUNT(*) as 'Record Count'
FROM tbl_pendaftaran_jamaah
UNION ALL
SELECT 'tbl_pembayaran', COUNT(*) FROM tbl_pembayaran
UNION ALL
SELECT 'tbl_paket_keberangkatan', COUNT(*) FROM tbl_paket_keberangkatan
UNION ALL
SELECT 'users', COUNT(*) FROM users
UNION ALL
SELECT 'bookings', COUNT(*) FROM bookings
UNION ALL
SELECT 'payments', COUNT(*) FROM payments
UNION ALL
SELECT 'packages', COUNT(*) FROM packages;

-- ============================================
-- COMMIT ROLLBACK
-- ============================================

COMMIT;

SELECT '✅ ROLLBACK COMPLETED! System restored to pre-migration state.' as 'Status';
SELECT 'Please restart application and verify everything works normally.' as 'Next Step';
