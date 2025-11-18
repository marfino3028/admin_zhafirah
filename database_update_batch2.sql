-- Update Database Structure untuk Screenshot Baru
-- Tambahan untuk tabel yang sudah ada

-- Update Tabel Pendaftaran Jamaah (tambah kolom yang dibutuhkan)
ALTER TABLE `tbl_pendaftaran_jamaah` 
ADD COLUMN IF NOT EXISTS `kode_registrasi` varchar(50) NOT NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `tanggal_registrasi` date NOT NULL AFTER `kode_registrasi`,
ADD COLUMN IF NOT EXISTS `nik` varchar(20) NOT NULL AFTER `tanggal_registrasi`,
ADD COLUMN IF NOT EXISTS `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL AFTER `nama_jamaah`,
ADD COLUMN IF NOT EXISTS `kota_kabupaten` varchar(100) DEFAULT NULL AFTER `alamat`;

-- Insert sample data pendaftaran haji
INSERT INTO `tbl_pendaftaran_jamaah` (`kode_registrasi`, `tanggal_registrasi`, `nik`, `id_paket_keberangkatan`, `nama_jamaah`, `jenis_kelamin`, `tanggal_lahir`, `kota_kabupaten`, `status`) VALUES
('RH-00001', '2025-07-17', '7311055103760007', 4, 'ABDULLAH RAHMAT', 'Laki-Laki', '1991-07-17', 'Surabaya', 'active');

-- Insert sample data pendaftaran umroh
INSERT INTO `tbl_pendaftaran_jamaah` (`kode_registrasi`, `tanggal_registrasi`, `nik`, `id_paket_keberangkatan`, `nama_jamaah`, `jenis_kelamin`, `tanggal_lahir`, `kota_kabupaten`, `status`) VALUES
('RU-00004', '2025-10-16', '00000', 1, 'Fulan', 'Laki-Laki', '1996-01-31', '', 'active'),
('RU-00003', '2025-10-14', '98923894798', 2, 'Nurdin Nanda', 'Laki-Laki', '2025-10-14', '89080', 'active'),
('RU-00002', '2025-07-17', '7311055103760008', 1, 'AISYAH FAUZIAH', 'Perempuan', '1993-07-17', 'Bogor', 'active'),
('RU-00001', '2025-07-16', '7311055103760006', 2, 'MUHAMMAD HANIF', 'Laki-Laki', '1991-07-16', 'Sumedang', 'active');

-- Update Tabel Pembayaran (tambah kolom yang dibutuhkan)
ALTER TABLE `tbl_pembayaran` 
ADD COLUMN IF NOT EXISTS `kode_transaksi` varchar(50) NOT NULL AFTER `id`,
ADD COLUMN IF NOT EXISTS `status_pembayaran` enum('check','confirmed') DEFAULT 'check' AFTER `metode_bayar`,
ADD COLUMN IF NOT EXISTS `kode_referensi` varchar(100) DEFAULT NULL AFTER `status_pembayaran`;

-- Insert sample data pembayaran haji
INSERT INTO `tbl_pembayaran` (`kode_transaksi`, `id_pendaftaran`, `tanggal_bayar`, `jumlah_bayar`, `metode_bayar`, `status_pembayaran`, `kode_referensi`) VALUES
('INV/CRJ-00014/KH-00001/250717', 1, '2025-07-17', 100000000.00, 'transfer', 'check', ''),
('INV/CRJ-00009/KH-00001/250713', 1, '2025-07-13', 5000000.00, 'cash', 'check', ''),
('INV/CRJ-00009/KH-00001/250712', 1, '2025-07-12', 50000000.00, 'transfer', 'confirmed', '');

-- Insert sample data pembayaran umroh  
INSERT INTO `tbl_pembayaran` (`kode_transaksi`, `id_pendaftaran`, `tanggal_bayar`, `jumlah_bayar`, `metode_bayar`, `status_pembayaran`, `kode_referensi`) VALUES
('INV/CRJ-00020/KU-00013/251016', 2, '2025-10-16', 24000000.00, 'cash', 'check', ''),
('INV/CRJ-00020/KU-00013/251016', 2, '2025-10-16', 5000000.00, 'transfer', 'check', ''),
('INV/CRJ-00011/KU-00001/251015', 5, '2025-10-15', 10000000.00, 'transfer', 'confirmed', '');

-- Tabel Pengeluaran Haji (sama seperti pengeluaran umroh)
CREATE TABLE IF NOT EXISTS `tbl_pengeluaran_haji` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `kode_pengeluaran` varchar(50) NOT NULL,
  `id_paket_keberangkatan` int(11) NOT NULL,
  `tanggal_pengeluaran` date NOT NULL,
  `jenis_pengeluaran` enum('paket haji','tiket pesawat','visa','hotel','transport','lainnya') NOT NULL,
  `nama_pengeluaran` varchar(200) NOT NULL,
  `jumlah` decimal(15,2) NOT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`id_paket_keberangkatan`) REFERENCES `tbl_paket_keberangkatan`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample pengeluaran haji
INSERT INTO `tbl_pengeluaran_haji` (`kode_pengeluaran`, `id_paket_keberangkatan`, `tanggal_pengeluaran`, `jenis_pengeluaran`, `nama_pengeluaran`, `jumlah`) VALUES
('CH-00005', 4, '2025-07-25', 'paket haji', 'Paket haji armuzna 10 pax', 250000000.00);
