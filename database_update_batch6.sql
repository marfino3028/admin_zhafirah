-- Database Update Batch 6

-- Tabel Surat Izin Cuti
CREATE TABLE IF NOT EXISTS `tbl_surat_izin_cuti`(
`id` INT AUTO_INCREMENT PRIMARY KEY,
`id_jamaah` INT NOT NULL,
`kode_jamaah` VARCHAR(50),
`tanggal_dokumen` DATE NOT NULL,
`tanggal_lahir` DATE,
`tanggal_keberangkatan` DATE,
`tanggal_kepulangan` DATE,
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY(`id_jamaah`)REFERENCES `tbl_pendaftaran_jamaah`(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Update tbl_agent (tambah kolom)
ALTER TABLE `tbl_agent`
ADD COLUMN IF NOT EXISTS `email` VARCHAR(100),
ADD COLUMN IF NOT EXISTS `tempat_lahir` VARCHAR(100),
ADD COLUMN IF NOT EXISTS `alamat` TEXT,
ADD COLUMN IF NOT EXISTS `catatan` TEXT,
ADD COLUMN IF NOT EXISTS `foto` VARCHAR(255);

-- Update tbl_pendaftaran_jamaah (tambah kolom)
ALTER TABLE `tbl_pendaftaran_jamaah`
ADD COLUMN IF NOT EXISTS `tempat_lahir` VARCHAR(100),
ADD COLUMN IF NOT EXISTS `catatan` TEXT,
ADD COLUMN IF NOT EXISTS `foto` VARCHAR(255);

-- Sample data Surat Izin Cuti
INSERT INTO `tbl_surat_izin_cuti`(`id_jamaah`,`kode_jamaah`,`tanggal_dokumen`,`tanggal_lahir`,`tanggal_keberangkatan`,`tanggal_kepulangan`)VALUES
(1,'J-00009','2025-07-18','1988-10-18','2025-12-25','2025-12-25');

-- Create upload directories (manual creation needed)
-- uploads/agent/
-- uploads/jamaah/
