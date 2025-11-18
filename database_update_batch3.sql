-- Database Update Batch 3
-- Tabel baru dan update untuk screenshot 11-15

-- Tabel Surat Rekomendasi
CREATE TABLE IF NOT EXISTS `tbl_surat_rekomendasi`(
`id` INT AUTO_INCREMENT PRIMARY KEY,
`id_jamaah` INT NOT NULL,
`kode_jamaah` VARCHAR(50),
`tanggal_dokumen` DATE NOT NULL,
`tanggal_lahir` DATE,
`tanggal_kepulangan` DATE,
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY(`id_jamaah`)REFERENCES `tbl_pendaftaran_jamaah`(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Karyawan
CREATE TABLE IF NOT EXISTS `tbl_karyawan`(
`id` INT AUTO_INCREMENT PRIMARY KEY,
`kode_karyawan` VARCHAR(50) NOT NULL,
`nik` VARCHAR(20) NOT NULL,
`nama_karyawan` VARCHAR(100) NOT NULL,
`kontak` VARCHAR(20),
`jenis_kelamin` ENUM('Laki-Laki','Perempuan'),
`tanggal_lahir` DATE,
`gaji` DECIMAL(15,2),
`kota_kabupaten` VARCHAR(100),
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Agent
CREATE TABLE IF NOT EXISTS `tbl_agent`(
`id` INT AUTO_INCREMENT PRIMARY KEY,
`kode_agent` VARCHAR(50) NOT NULL,
`nik` VARCHAR(20) NOT NULL,
`nama_agent` VARCHAR(100) NOT NULL,
`kontak` VARCHAR(20),
`jenis_kelamin` ENUM('Laki-Laki','Perempuan'),
`tanggal_lahir` DATE,
`kota_kabupaten` VARCHAR(100),
`status` ENUM('active','inactive')DEFAULT'active',
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Update tbl_maskapai (tambah kolom)
ALTER TABLE `tbl_maskapai`
ADD COLUMN IF NOT EXISTS `rute_penerbangan` VARCHAR(100),
ADD COLUMN IF NOT EXISTS `lama_perjalanan` VARCHAR(50),
ADD COLUMN IF NOT EXISTS `harga_tiket` DECIMAL(15,2);

-- Update tbl_pendaftaran_jamaah (tambah kolom paspor)
ALTER TABLE `tbl_pendaftaran_jamaah`
ADD COLUMN IF NOT EXISTS `nama_paspor` VARCHAR(100),
ADD COLUMN IF NOT EXISTS `nomor_paspor` VARCHAR(50);

-- Sample data
INSERT INTO `tbl_karyawan`(`kode_karyawan`,`nik`,`nama_karyawan`,`kontak`,`jenis_kelamin`,`tanggal_lahir`,`gaji`,`kota_kabupaten`)VALUES
('K-00001','721100000000000','AHMAD','0817-1788-8989','Laki-Laki','2025-06-23',1200000.00,'MAJALENGKA');

INSERT INTO `tbl_agent`(`kode_agent`,`nik`,`nama_agent`,`kontak`,`jenis_kelamin`,`tanggal_lahir`,`kota_kabupaten`)VALUES
('A-00003','727172731237','Muhammad Arsyad Ambo Dalle','0000','Laki-Laki','2025-10-14','Luwu'),
('A-00001','7321111111111111','RAIHAN','0817-1788-8989','Laki-Laki','1991-02-28','MAJAKENGKA');

INSERT INTO `tbl_surat_rekomendasi`(`id_jamaah`,`kode_jamaah`,`tanggal_dokumen`,`tanggal_lahir`,`tanggal_kepulangan`)VALUES
(1,'J-00001','2025-10-14','1958-10-15','2025-12-25'),
(2,'J-00007','2025-10-14','2005-10-16','2025-12-25'),
(3,'J-00001','2025-07-17','1958-10-15','2025-12-12');

UPDATE `tbl_maskapai` SET `rute_penerbangan`='Transit',`lama_perjalanan`='12 Jam',`harga_tiket`=11000000 WHERE `kode_maskapai`='MK-00003';
UPDATE `tbl_maskapai` SET `rute_penerbangan`='Direct',`lama_perjalanan`='10 Jam',`harga_tiket`=12000000 WHERE `kode_maskapai`='MK-00001';
