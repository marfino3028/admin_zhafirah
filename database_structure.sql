-- Database structure untuk Zhafirah Umroh System
-- Pastikan database 'zhafirah' sudah dibuat

-- Tabel Maskapai
CREATE TABLE IF NOT EXISTS `tbl_maskapai` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `kode_maskapai` varchar(20) NOT NULL,
  `nama_maskapai` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample maskapai
INSERT INTO `tbl_maskapai` (`kode_maskapai`, `nama_maskapai`) VALUES
('QR', 'Qatar Airways'),
('SV', 'Saudia Airline'),
('EY', 'Etihad Airways'),
('GA', 'Garuda Indonesia');

-- Tabel Paket Keberangkatan
CREATE TABLE IF NOT EXISTS `tbl_paket_keberangkatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `kode_keberangkatan` varchar(50) NOT NULL,
  `nama_paket` varchar(200) NOT NULL,
  `jenis_paket` enum('umroh','haji') NOT NULL,
  `tanggal_keberangkatan` date NOT NULL,
  `lokasi_keberangkatan` varchar(100) NOT NULL,
  `id_maskapai` int(11) NOT NULL,
  `jumlah_hari` int(11) NOT NULL,
  `harga_paket` decimal(15,2) NOT NULL,
  `kuota_jamaah` int(11) NOT NULL,
  `status_paket` enum('open','closed') DEFAULT 'open',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_maskapai`) REFERENCES `tbl_maskapai`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data
INSERT INTO `tbl_paket_keberangkatan` (`kode_keberangkatan`, `nama_paket`, `jenis_paket`, `tanggal_keberangkatan`, `lokasi_keberangkatan`, `id_maskapai`, `jumlah_hari`, `harga_paket`, `kuota_jamaah`, `status_paket`) VALUES
('KU-00001', 'UMROH 25 DESEMBER 2025 (Batch-1)', 'umroh', '2025-12-25', 'Jakarta', 1, 12, 28500000.00, 40, 'open'),
('KU-00003', 'UMROH 25 DESEMBER 2025 (Batch-2)', 'umroh', '2025-12-25', 'Jakarta', 1, 12, 28500000.00, 40, 'open'),
('KU-00013', 'UMROH 12 DESEMBER 2025 (Batch-1)', 'umroh', '2025-12-12', 'Jakarta', 2, 10, 24000000.00, 40, 'open'),
('KH-00001', 'HAJI FAST TRACK 2026 | 1447 H (Batch-1)', 'haji', '2026-03-10', 'Jakarta', 1, 22, 70000000.00, 70, 'open');

-- Tabel Pendaftaran Jamaah
CREATE TABLE IF NOT EXISTS `tbl_pendaftaran_jamaah` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_paket_keberangkatan` int(11) NOT NULL,
  `nama_jamaah` varchar(100) NOT NULL,
  `no_identitas` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text,
  `telepon` varchar(20),
  `email` varchar(100),
  `status` enum('active','cancelled') DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_paket_keberangkatan`) REFERENCES `tbl_paket_keberangkatan`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Pembayaran
CREATE TABLE IF NOT EXISTS `tbl_pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_pendaftaran` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `jumlah_bayar` decimal(15,2) NOT NULL,
  `metode_bayar` varchar(50),
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_pendaftaran`) REFERENCES `tbl_pendaftaran_jamaah`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Tabungan
CREATE TABLE IF NOT EXISTS `tbl_tabungan` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_jamaah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_jamaah`) REFERENCES `tbl_pendaftaran_jamaah`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Pengeluaran Umum
CREATE TABLE IF NOT EXISTS `tbl_pengeluaran_umum` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `kode_pengeluaran` varchar(50) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `jenis_pengeluaran` enum('operasional','karyawan','transport','lainnya') NOT NULL,
  `nama_pengeluaran` varchar(200) NOT NULL,
  `jumlah_pengeluaran` decimal(15,2) NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample pengeluaran umum
INSERT INTO `tbl_pengeluaran_umum` (`kode_pengeluaran`, `tanggal_pengeluaran`, `jenis_pengeluaran`, `nama_pengeluaran`, `jumlah_pengeluaran`) VALUES
('CG-00007', '2025-06-16', 'operasional', 'Manasik jamaah umroh 10 pxa', 3000000.00),
('CG-00006', '2025-07-26', 'karyawan', 'Gaji karyawan 3 orang', 6000000.00);

-- Tabel Pengeluaran Umroh
CREATE TABLE IF NOT EXISTS `tbl_pengeluaran_umroh` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `kode_pengeluaran` varchar(50) NOT NULL,
  `id_paket_keberangkatan` int(11) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `jenis_pengeluaran` enum('tiket pesawat','visa umroh','hotel','transport','lainnya') NOT NULL,
  `nama_pengeluaran` varchar(200) NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_paket_keberangkatan`) REFERENCES `tbl_paket_keberangkatan`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample pengeluaran umroh
INSERT INTO `tbl_pengeluaran_umroh` (`kode_pengeluaran`, `id_paket_keberangkatan`, `tanggal_pengeluaran`, `jenis_pengeluaran`, `nama_pengeluaran`, `jumlah`) VALUES
('CU-00004', 1, '2025-07-25', 'tiket pesawat', 'Bayar tiket pesawat 5 pax', 75000000.00),
('CU-00001', 3, '2025-07-25', 'visa umroh', 'Bayar visa 10 pax', 20000000.00);

-- Tabel Menu (untuk sistem menu dinamis)
CREATE TABLE IF NOT EXISTS `tbl_kat_menu` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nm_ka_menu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbl_kat_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nm_ka_menu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `kategori_id` int(11) NOT NULL,
  `kategori_sub_id` int(11) DEFAULT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `link` varchar(200) NOT NULL,
  FOREIGN KEY (`kategori_id`) REFERENCES `tbl_kat_menu`(`kategori_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbl_user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `userid` varchar(50) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `hak_akses` enum('0','1') DEFAULT '0',
  FOREIGN KEY (`userid`) REFERENCES `tbl_user`(`userid`),
  FOREIGN KEY (`menu_id`) REFERENCES `tbl_menu`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
