-- ============================================
-- MIGRATION SCRIPT: Portal Jamaah + Admin Panel Integration
-- Database: zhafirah
-- Created: 2025-11-20
-- ============================================

-- SAFETY FIRST: Set autocommit off untuk bisa rollback
SET autocommit = 0;
START TRANSACTION;

-- ============================================
-- STEP 0: CREATE BACKUP TABLES
-- ============================================
SELECT 'Creating backup tables...' as 'Status';

CREATE TABLE IF NOT EXISTS _backup_tbl_pendaftaran_jamaah AS SELECT * FROM tbl_pendaftaran_jamaah WHERE 1=1;
CREATE TABLE IF NOT EXISTS _backup_tbl_pembayaran AS SELECT * FROM tbl_pembayaran WHERE 1=1;
CREATE TABLE IF NOT EXISTS _backup_tbl_paket_keberangkatan AS SELECT * FROM tbl_paket_keberangkatan WHERE 1=1;
CREATE TABLE IF NOT EXISTS _backup_tbl_pemasukan_umum AS SELECT * FROM tbl_pemasukan_umum WHERE 1=1;
CREATE TABLE IF NOT EXISTS _backup_users AS SELECT * FROM users WHERE 1=1;
CREATE TABLE IF NOT EXISTS _backup_bookings AS SELECT * FROM bookings WHERE 1=1;
CREATE TABLE IF NOT EXISTS _backup_payments AS SELECT * FROM payments WHERE 1=1;
CREATE TABLE IF NOT EXISTS _backup_packages AS SELECT * FROM packages WHERE 1=1;

SELECT 'Backup tables created successfully!' as 'Status';

-- ============================================
-- STEP 1: ALTER TABLES - Add Missing Columns
-- ============================================
SELECT 'Altering tables to add missing columns...' as 'Status';

-- Users table enhancements
ALTER TABLE `users` 
ADD COLUMN IF NOT EXISTS `admin_notes` TEXT NULL COMMENT 'Catatan dari admin',
ADD COLUMN IF NOT EXISTS `referral_source` VARCHAR(100) NULL COMMENT 'Sumber referral',
ADD COLUMN IF NOT EXISTS `emergency_contact` VARCHAR(100) NULL COMMENT 'Kontak darurat',
ADD COLUMN IF NOT EXISTS `emergency_phone` VARCHAR(20) NULL COMMENT 'Nomor kontak darurat';

-- Bookings table enhancements  
ALTER TABLE `bookings`
ADD COLUMN IF NOT EXISTS `jamaah_type` ENUM('individu','group') DEFAULT 'individu' COMMENT 'Tipe pendaftaran',
ADD COLUMN IF NOT EXISTS `room_type` VARCHAR(50) NULL COMMENT 'Tipe kamar',
ADD COLUMN IF NOT EXISTS `special_requests` TEXT NULL COMMENT 'Permintaan khusus',
ADD COLUMN IF NOT EXISTS `approved_by` INT NULL COMMENT 'ID admin yang approve',
ADD COLUMN IF NOT EXISTS `approved_at` TIMESTAMP NULL COMMENT 'Tanggal approval',
ADD COLUMN IF NOT EXISTS `departure_city` VARCHAR(100) NULL COMMENT 'Kota keberangkatan',
ADD COLUMN IF NOT EXISTS `return_city` VARCHAR(100) NULL COMMENT 'Kota kepulangan';

-- Payments table enhancements
ALTER TABLE `payments`
ADD COLUMN IF NOT EXISTS `payment_sequence` INT DEFAULT 1 COMMENT 'Pembayaran ke-X',
ADD COLUMN IF NOT EXISTS `verified_by` INT NULL COMMENT 'ID admin yang verify',
ADD COLUMN IF NOT EXISTS `verified_at` TIMESTAMP NULL COMMENT 'Tanggal verification',
ADD COLUMN IF NOT EXISTS `bank_name` VARCHAR(100) NULL COMMENT 'Nama bank',
ADD COLUMN IF NOT EXISTS `account_number` VARCHAR(50) NULL COMMENT 'Nomor rekening',
ADD COLUMN IF NOT EXISTS `account_name` VARCHAR(100) NULL COMMENT 'Nama pemilik rekening';

SELECT 'Tables altered successfully!' as 'Status';

-- ============================================
-- STEP 2: MIGRATE PACKAGES (if needed)
-- ============================================
SELECT 'Migrating packages data...' as 'Status';

-- Hanya migrasi paket yang belum ada di packages table
INSERT INTO packages (
    package_code,
    package_name,
    package_type,
    description,
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
    featured,
    created_at,
    updated_at
)
SELECT 
    IFNULL(kode_paket, CONCAT('PKG-', id_paket)),
    nama_paket,
    LOWER(jenis_paket),
    keterangan,
    harga_paket,
    IFNULL(lama_hari, 9),
    tanggal_keberangkatan,
    IFNULL(kuota_jamaah, 45),
    IFNULL(kuota_jamaah, 45) - (
        SELECT COUNT(*) 
        FROM tbl_pendaftaran_jamaah 
        WHERE id_paket = tp.id_paket 
        AND status IN ('Approved', 'Confirmed')
    ),
    fasilitas,
    NULL,
    hotel_makkah,
    hotel_madinah,
    maskapai,
    CASE 
        WHEN status = 'Active' THEN 'active'
        WHEN status = 'Full' THEN 'full'
        ELSE 'inactive'
    END,
    IF(featured = 1 OR is_featured = 1, 1, 0),
    IFNULL(created_at, NOW()),
    IFNULL(updated_at, NOW())
FROM tbl_paket_keberangkatan tp
WHERE NOT EXISTS (
    SELECT 1 FROM packages p WHERE p.package_code = IFNULL(tp.kode_paket, CONCAT('PKG-', tp.id_paket))
);

SELECT CONCAT('Migrated ', ROW_COUNT(), ' packages') as 'Status';

-- ============================================
-- STEP 3: MIGRATE USERS/JAMAAH
-- ============================================
SELECT 'Migrating jamaah to users table...' as 'Status';

-- Migrasi jamaah yang belum punya akun
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
    password,
    is_active,
    email_verified,
    admin_notes,
    created_at,
    updated_at
)
SELECT DISTINCT
    pj.nama_jamaah,
    IFNULL(
        NULLIF(pj.email, ''),
        CONCAT('jamaah_', pj.id_jamaah, '@zhafirah.temp')
    ) as email,
    pj.no_hp,
    IFNULL(NULLIF(pj.no_wa, ''), pj.no_hp) as whatsapp,
    pj.tanggal_lahir,
    pj.jenis_kelamin,
    pj.alamat_lengkap,
    pj.kota,
    pj.provinsi,
    pj.kode_pos,
    pj.no_ktp,
    pj.no_paspor,
    pj.tanggal_expired_paspor,
    '$2y$10$defaultHashForMigration' as password,
    1 as is_active,
    0 as email_verified,
    CONCAT('Migrasi dari admin panel. ID Lama: ', pj.id_jamaah) as admin_notes,
    IFNULL(pj.created_at, NOW()),
    IFNULL(pj.updated_at, NOW())
FROM tbl_pendaftaran_jamaah pj
WHERE pj.no_hp IS NOT NULL
  AND pj.no_hp != ''
  AND NOT EXISTS (
      SELECT 1 FROM users u WHERE u.phone = pj.no_hp
  );

SELECT CONCAT('Migrated ', ROW_COUNT(), ' jamaah to users') as 'Status';

-- ============================================
-- STEP 4: MIGRATE BOOKINGS
-- ============================================
SELECT 'Migrating pendaftaran to bookings...' as 'Status';

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
    special_requests,
    departure_city,
    created_at,
    updated_at
)
SELECT 
    IFNULL(pj.kode_pendaftaran, CONCAT('BK-OLD-', pj.id_pendaftaran)),
    (
        SELECT id 
        FROM users 
        WHERE phone = pj.no_hp 
        LIMIT 1
    ) as user_id,
    (
        SELECT id 
        FROM packages 
        WHERE package_code = (
            SELECT IFNULL(kode_paket, CONCAT('PKG-', id_paket))
            FROM tbl_paket_keberangkatan
            WHERE id_paket = pj.id_paket
            LIMIT 1
        )
        LIMIT 1
    ) as package_id,
    (
        SELECT harga_paket 
        FROM tbl_paket_keberangkatan 
        WHERE id_paket = pj.id_paket 
        LIMIT 1
    ) as total_amount,
    CASE 
        WHEN pj.status = 'Approved' OR pj.status = 'Confirmed' THEN 'confirmed'
        WHEN pj.status = 'Pending' THEN 'pending'
        WHEN pj.status = 'Cancelled' THEN 'cancelled'
        ELSE 'pending'
    END as status,
    CASE 
        WHEN (
            SELECT SUM(jumlah_bayar) 
            FROM tbl_pembayaran 
            WHERE id_pendaftaran = pj.id_pendaftaran 
            AND status = 'Verified'
        ) >= (
            SELECT harga_paket 
            FROM tbl_paket_keberangkatan 
            WHERE id_paket = pj.id_paket
        ) THEN 'paid'
        WHEN (
            SELECT COUNT(*) 
            FROM tbl_pembayaran 
            WHERE id_pendaftaran = pj.id_pendaftaran
        ) > 0 THEN 'pending'
        ELSE 'unpaid'
    END as payment_status,
    pj.catatan,
    IFNULL(pj.jenis_pendaftaran, 'individu'),
    pj.jenis_kamar,
    pj.catatan_khusus,
    pj.kota_keberangkatan,
    IFNULL(pj.created_at, NOW()),
    IFNULL(pj.updated_at, NOW())
FROM tbl_pendaftaran_jamaah pj
WHERE NOT EXISTS (
    SELECT 1 
    FROM bookings b 
    WHERE b.booking_code = IFNULL(pj.kode_pendaftaran, CONCAT('BK-OLD-', pj.id_pendaftaran))
)
AND (
    SELECT id 
    FROM users 
    WHERE phone = pj.no_hp 
    LIMIT 1
) IS NOT NULL;

SELECT CONCAT('Migrated ', ROW_COUNT(), ' bookings') as 'Status';

-- ============================================
-- STEP 5: MIGRATE PAYMENTS
-- ============================================
SELECT 'Migrating pembayaran to payments...' as 'Status';

INSERT INTO payments (
    booking_id,
    payment_code,
    amount,
    payment_date,
    payment_method,
    payment_status,
    payment_sequence,
    payment_proof,
    bank_name,
    account_number,
    account_name,
    notes,
    verified_by,
    verified_at,
    created_at,
    updated_at
)
SELECT 
    (
        SELECT id 
        FROM bookings 
        WHERE booking_code = (
            SELECT IFNULL(kode_pendaftaran, CONCAT('BK-OLD-', id_pendaftaran))
            FROM tbl_pendaftaran_jamaah
            WHERE id_pendaftaran = pb.id_pendaftaran
            LIMIT 1
        )
        LIMIT 1
    ) as booking_id,
    IFNULL(pb.kode_pembayaran, CONCAT('PAY-OLD-', pb.id_pembayaran)) as payment_code,
    pb.jumlah_bayar as amount,
    pb.tanggal_bayar as payment_date,
    CASE 
        WHEN pb.metode_pembayaran = 'Transfer' THEN 'bank_transfer'
        WHEN pb.metode_pembayaran = 'Cash' THEN 'cash'
        WHEN pb.metode_pembayaran = 'Kartu Kredit' THEN 'credit_card'
        ELSE 'other'
    END as payment_method,
    CASE 
        WHEN pb.status = 'Verified' OR pb.status = 'Confirmed' THEN 'success'
        WHEN pb.status = 'Pending' THEN 'pending'
        WHEN pb.status = 'Rejected' THEN 'failed'
        ELSE 'pending'
    END as payment_status,
    IFNULL(pb.pembayaran_ke, 1) as payment_sequence,
    pb.bukti_transfer as payment_proof,
    pb.nama_bank as bank_name,
    pb.nomor_rekening as account_number,
    pb.nama_rekening as account_name,
    pb.catatan as notes,
    pb.verified_by_admin as verified_by,
    pb.verified_at,
    IFNULL(pb.created_at, NOW()),
    IFNULL(pb.updated_at, NOW())
FROM tbl_pembayaran pb
WHERE NOT EXISTS (
    SELECT 1 
    FROM payments p 
    WHERE p.payment_code = IFNULL(pb.kode_pembayaran, CONCAT('PAY-OLD-', pb.id_pembayaran))
)
AND (
    SELECT id 
    FROM bookings 
    WHERE booking_code = (
        SELECT IFNULL(kode_pendaftaran, CONCAT('BK-OLD-', id_pendaftaran))
        FROM tbl_pendaftaran_jamaah
        WHERE id_pendaftaran = pb.id_pendaftaran
        LIMIT 1
    )
    LIMIT 1
) IS NOT NULL;

SELECT CONCAT('Migrated ', ROW_COUNT(), ' payments') as 'Status';

-- ============================================
-- STEP 6: CREATE VIEW FOR UNIFIED INCOME REPORT
-- ============================================
SELECT 'Creating unified income view...' as 'Status';

CREATE OR REPLACE VIEW v_all_pemasukan AS
SELECT 
    'booking' as source_type,
    p.id,
    b.booking_code as reference_code,
    u.full_name as customer_name,
    p.amount,
    p.payment_date as transaction_date,
    p.payment_method,
    p.payment_status as status,
    CONCAT('Pembayaran ', p.payment_sequence, ' - ', b.booking_code) as description,
    p.created_at,
    p.updated_at
FROM payments p
JOIN bookings b ON p.booking_id = b.id
JOIN users u ON b.user_id = u.id
WHERE p.payment_status = 'success'

UNION ALL

SELECT 
    'general' as source_type,
    pu.id_pemasukan as id,
    pu.kode_pemasukan as reference_code,
    pu.nama_pengirim as customer_name,
    pu.jumlah as amount,
    pu.tanggal_pemasukan as transaction_date,
    'other' as payment_method,
    'success' as status,
    pu.keterangan as description,
    pu.created_at,
    pu.updated_at
FROM tbl_pemasukan_umum pu;

SELECT 'Unified income view created!' as 'Status';

-- ============================================
-- STEP 7: UPDATE PACKAGE REMAINING QUOTA
-- ============================================
SELECT 'Updating package remaining quota...' as 'Status';

UPDATE packages p
SET remaining_quota = quota - (
    SELECT COUNT(*) 
    FROM bookings b 
    WHERE b.package_id = p.id 
    AND b.status IN ('pending', 'confirmed', 'paid')
);

SELECT 'Package quota updated!' as 'Status';

-- ============================================
-- STEP 8: RENAME OLD TABLES (Mark as deprecated)
-- ============================================
SELECT 'Renaming old tables...' as 'Status';

-- Jangan DROP, tapi RENAME untuk safety
RENAME TABLE tbl_pendaftaran_jamaah TO _deprecated_tbl_pendaftaran_jamaah;
RENAME TABLE tbl_pembayaran TO _deprecated_tbl_pembayaran;
RENAME TABLE tbl_paket_keberangkatan TO _deprecated_tbl_paket_keberangkatan;
-- tbl_pemasukan_umum TETAP (digunakan untuk pemasukan non-booking)

SELECT 'Old tables renamed with _deprecated prefix' as 'Status';

-- ============================================
-- FINAL CHECK
-- ============================================
SELECT 'Running final checks...' as 'Status';

SELECT 
    'Users' as 'Table',
    COUNT(*) as 'Total Records'
FROM users
UNION ALL
SELECT 'Packages', COUNT(*) FROM packages
UNION ALL
SELECT 'Bookings', COUNT(*) FROM bookings
UNION ALL
SELECT 'Payments', COUNT(*) FROM payments;

-- ============================================
-- COMMIT OR ROLLBACK
-- ============================================
-- Review hasil di atas, jika OK:
-- COMMIT;

-- Jika ada error:
-- ROLLBACK;

SELECT '✅ MIGRATION COMPLETED! Review results and COMMIT if OK, or ROLLBACK if there are issues.' as 'Status';
SELECT 'Use: COMMIT; to apply changes or ROLLBACK; to undo' as 'Action Required';
