-- Database Update Batch 5

-- Tabel Pemasukan Umum
CREATE TABLE IF NOT EXISTS `tbl_pemasukan_umum`(
`id` INT AUTO_INCREMENT PRIMARY KEY,
`kode_pemasukan` VARCHAR(50) NOT NULL,
`tanggal_pemasukan` DATE NOT NULL,
`jenis_pemasukan` ENUM('penjualan','investasi','lainnya') NOT NULL,
`nama_pemasukan` VARCHAR(200) NOT NULL,
`jumlah_pemasukan` DECIMAL(15,2) NOT NULL,
`keterangan` TEXT,
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Paket
CREATE TABLE IF NOT EXISTS `tbl_paket`(
`id` INT AUTO_INCREMENT PRIMARY KEY,
`kode_paket` VARCHAR(50) NOT NULL,
`nama_paket` VARCHAR(200) NOT NULL,
`jenis_paket` ENUM('umroh','haji') NOT NULL,
`tanggal_keberangkatan` DATE NOT NULL,
`jumlah_hari` INT NOT NULL,
`id_maskapai` INT NOT NULL,
`lokasi_keberangkatan` VARCHAR(100),
`harga_paket` DECIMAL(15,2) NOT NULL,
`kuota_jamaah` INT NOT NULL,
`foto_brosur` VARCHAR(255),
`status` ENUM('active','inactive') DEFAULT 'active',
`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
FOREIGN KEY(`id_maskapai`)REFERENCES `tbl_maskapai`(`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data Pemasukan
INSERT INTO `tbl_pemasukan_umum`(`kode_pemasukan`,`tanggal_pemasukan`,`jenis_pemasukan`,`nama_pemasukan`,`jumlah_pemasukan`)VALUES
('CR-00002','2025-05-30','lainnya','Beli paket data',350000),
('CR-00001','2025-07-31','lainnya','Beli paket data',250000);

-- Sample data Paket
INSERT INTO `tbl_paket`(`kode_paket`,`nama_paket`,`jenis_paket`,`tanggal_keberangkatan`,`jumlah_hari`,`id_maskapai`,`lokasi_keberangkatan`,`harga_paket`,`kuota_jamaah`,`status`)VALUES
('PH-00002','HAJI FURODA 2026 | 1447 H','haji','2026-03-10',25,2,'Jakarta',305000000,65,'active'),
('PH-00001','HAJI FAST TRACK 2026 | 1447 H','haji','2026-03-10',22,1,'Jakarta',245000000,70,'active'),
('PU-00004','UMROH 25 DESEMBER 2025','umroh','2025-12-25',12,1,'Jakarta',34500000,40,'active'),
('PU-00001','UMROH 12 DESEMBER 2025','umroh','2025-12-12',10,2,'Jakarta',30500000,35,'active');
