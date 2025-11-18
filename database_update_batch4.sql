-- Database Update Batch 4

-- Tabel Hotel
CREATE TABLE IF NOT EXISTS `tbl_hotel`(
`id` INT AUTO_INCREMENT PRIMARY KEY,
`kode_hotel` VARCHAR(50) NOT NULL,
`nama_hotel` VARCHAR(100) NOT NULL,
`lokasi_hotel` VARCHAR(100),
`kontak_hotel` VARCHAR(20),
`email_hotel` VARCHAR(100),
`rating_hotel` INT,
`harga_hotel` DECIMAL(15,2),
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Update tbl_pendaftaran_jamaah (tambah kolom manifest)
ALTER TABLE `tbl_pendaftaran_jamaah`
ADD COLUMN IF NOT EXISTS `habis_paspor` DATE,
ADD COLUMN IF NOT EXISTS `tipe_kamar` VARCHAR(50),
ADD COLUMN IF NOT EXISTS `jumlah_pax` INT;

-- Update tbl_paket_keberangkatan (tambah kolom)
ALTER TABLE `tbl_paket_keberangkatan`
ADD COLUMN IF NOT EXISTS `rute_penerbangan` VARCHAR(100);

-- Sample data Hotel
INSERT INTO `tbl_hotel`(`kode_hotel`,`nama_hotel`,`lokasi_hotel`,`kontak_hotel`,`email_hotel`,`rating_hotel`,`harga_hotel`)VALUES
('HT-00002','Lee Meridien Makkah','Mekkah','021-67783333','yusup.bisnis@gmail.com',5,1800000),
('HT-00001','Elaf Mashaer','Mekkah','021-67783333','yusup.bisnis@gmail.com',4,1500000);

-- Update sample data
UPDATE `tbl_pendaftaran_jamaah` SET `habis_paspor`='2025-10-16',`tipe_kamar`='Quad',`jumlah_pax`=5 WHERE `kode_registrasi`='RU-00004';
UPDATE `tbl_pendaftaran_jamaah` SET `habis_paspor`='2035-07-17',`tipe_kamar`='Quad',`jumlah_pax`=2 WHERE `kode_registrasi`='RU-00002';
UPDATE `tbl_paket_keberangkatan` SET `rute_penerbangan`='Direct' WHERE `kode_keberangkatan`='KU-00013';
UPDATE `tbl_paket_keberangkatan` SET `rute_penerbangan`='Transit' WHERE `kode_keberangkatan` IN('KU-00003','KU-00001');
UPDATE `tbl_paket_keberangkatan` SET `rute_penerbangan`='Direct' WHERE `jenis_paket`='haji';
