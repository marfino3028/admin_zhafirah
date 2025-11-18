-- Database Update Batch 7

-- Update tbl_pendaftaran_jamaah (tambah kolom foto dokumen)
ALTER TABLE `tbl_pendaftaran_jamaah`
ADD COLUMN IF NOT EXISTS `kantor_imigrasi` VARCHAR(100),
ADD COLUMN IF NOT EXISTS `paspor_aktif` DATE,
ADD COLUMN IF NOT EXISTS `foto_ktp` VARCHAR(255),
ADD COLUMN IF NOT EXISTS `foto_kk` VARCHAR(255),
ADD COLUMN IF NOT EXISTS `foto_paspor1` VARCHAR(255),
ADD COLUMN IF NOT EXISTS `foto_paspor2` VARCHAR(255);

-- Update tbl_karyawan (tambah kolom)
ALTER TABLE `tbl_karyawan`
ADD COLUMN IF NOT EXISTS `tempat_lahir` VARCHAR(100),
ADD COLUMN IF NOT EXISTS `alamat` TEXT,
ADD COLUMN IF NOT EXISTS `foto` VARCHAR(255);

-- Update tbl_paket (tambah kolom detail paket)
ALTER TABLE `tbl_paket`
ADD COLUMN IF NOT EXISTS `jenis_paket1` VARCHAR(100),
ADD COLUMN IF NOT EXISTS `hotel_mekkah1` INT,
ADD COLUMN IF NOT EXISTS `hotel_madinah1` INT,
ADD COLUMN IF NOT EXISTS `hotel_transit1` INT,
ADD COLUMN IF NOT EXISTS `harga_quad1` DECIMAL(15,2),
ADD COLUMN IF NOT EXISTS `harga_triple1` DECIMAL(15,2),
ADD COLUMN IF NOT EXISTS `harga_double1` DECIMAL(15,2),
ADD COLUMN IF NOT EXISTS `jenis_paket2` VARCHAR(100),
ADD COLUMN IF NOT EXISTS `hotel_mekkah2` INT,
ADD COLUMN IF NOT EXISTS `hotel_madinah2` INT,
ADD COLUMN IF NOT EXISTS `hotel_transit2` INT,
ADD COLUMN IF NOT EXISTS `harga_hpp2` DECIMAL(15,2),
ADD COLUMN IF NOT EXISTS `harga_quad2` DECIMAL(15,2),
ADD COLUMN IF NOT EXISTS `harga_triple2` DECIMAL(15,2),
ADD COLUMN IF NOT EXISTS `harga_double2` DECIMAL(15,2),
ADD COLUMN IF NOT EXISTS `termasuk` TEXT,
ADD COLUMN IF NOT EXISTS `tidak_termasuk` TEXT,
ADD COLUMN IF NOT EXISTS `syarat` TEXT,
ADD COLUMN IF NOT EXISTS `catatan` TEXT;

-- Create upload directories (manual)
-- uploads/karyawan/
-- uploads/paket/
