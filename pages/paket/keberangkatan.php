<?php
// Get data paket keberangkatan umroh
$paket_umroh = $db->query("SELECT pk.*, m.nama_maskapai, 
    (pk.kuota_jamaah - COALESCE(COUNT(pj.id), 0)) as sisa_kuota,
    COALESCE(COUNT(pj.id), 0) as kuota_terisi
    FROM tbl_paket_keberangkatan pk 
    LEFT JOIN tbl_maskapai m ON pk.id_maskapai=m.id
    LEFT JOIN tbl_pendaftaran_jamaah pj ON pk.id=pj.id_paket_keberangkatan AND pj.status!='cancelled'
    WHERE pk.jenis_paket='umroh' 
    GROUP BY pk.id
    ORDER BY pk.tanggal_keberangkatan DESC");

// Get data paket keberangkatan haji
$paket_haji = $db->query("SELECT pk.*, m.nama_maskapai,
    (pk.kuota_jamaah - COALESCE(COUNT(pj.id), 0)) as sisa_kuota,
    COALESCE(COUNT(pj.id), 0) as kuota_terisi
    FROM tbl_paket_keberangkatan pk 
    LEFT JOIN tbl_maskapai m ON pk.id_maskapai=m.id
    LEFT JOIN tbl_pendaftaran_jamaah pj ON pk.id=pj.id_paket_keberangkatan AND pj.status!='cancelled'
    WHERE pk.jenis_paket='haji'
    GROUP BY pk.id
    ORDER BY pk.tanggal_keberangkatan DESC");
?>

<style>
.table-section {
    background: white;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
.table-title {
    font-size: 18px;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid #ecf0f1;
}
.custom-table {
    width: 100%;
    border-collapse: collapse;
}
.custom-table thead th {
    background: #f8f9fa;
    padding: 15px 10px;
    text-align: left;
    font-size: 13px;
    font-weight: 600;
    color: #2c3e50;
    border-bottom: 2px solid #dee2e6;
}
.custom-table tbody td {
    padding: 15px 10px;
    border-bottom: 1px solid #ecf0f1;
    font-size: 14px;
    color: #2c3e50;
}
.custom-table tbody tr:hover {
    background: #f8f9fa;
}
.badge-open {
    background: #27ae60;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}
.badge-closed {
    background: #e74c3c;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}
</style>

<div class="row">
    <div class="col-md-12">
        <div class="table-section">
            <div class="table-title">Tabel : Data Paket Keberangkatan Umroh</div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Keberangkatan</th>
                            <th>Nama Keberangkatan</th>
                            <th>Tanggal Keberangkatan</th>
                            <th>Lokasi Keberangkatan</th>
                            <th>Pesawat / Maskapai</th>
                            <th>Jumlah Hari</th>
                            <th>Kuota Jamaah</th>
                            <th>Kuota Terisi</th>
                            <th>Sisa Kuota</th>
                            <th>Status Paket</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($paket_umroh) {
                            foreach($paket_umroh as $key => $row) { 
                                $tanggal = date('d M Y', strtotime($row['tanggal_keberangkatan']));
                        ?>
                        <tr>
                            <td><?php echo ($key + 1); ?></td>
                            <td><?php echo $row['kode_keberangkatan']; ?></td>
                            <td><?php echo $row['nama_paket']; ?></td>
                            <td><?php echo $tanggal; ?></td>
                            <td><?php echo $row['lokasi_keberangkatan']; ?></td>
                            <td><?php echo $row['nama_maskapai']; ?></td>
                            <td><?php echo $row['jumlah_hari']; ?> Hari</td>
                            <td><?php echo $row['kuota_jamaah']; ?> Pax</td>
                            <td><?php echo $row['kuota_terisi']; ?> Pax</td>
                            <td><?php echo $row['sisa_kuota']; ?> Pax</td>
                            <td>
                                <?php if($row['status_paket'] == 'open') { ?>
                                    <span class="badge-open">Open</span>
                                <?php } else { ?>
                                    <span class="badge-closed">Closed</span>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo '<tr><td colspan="11" style="text-align:center;">Tidak ada data</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="table-section">
            <div class="table-title">Tabel : Data Paket Keberangkatan Haji</div>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Keberangkatan</th>
                            <th>Nama Keberangkatan</th>
                            <th>Tanggal Keberangkatan</th>
                            <th>Lokasi Keberangkatan</th>
                            <th>Pesawat / Maskapai</th>
                            <th>Jumlah Hari</th>
                            <th>Kuota Jamaah</th>
                            <th>Kuota Terisi</th>
                            <th>Sisa Kuota</th>
                            <th>Status Paket</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($paket_haji) {
                            foreach($paket_haji as $key => $row) { 
                                $tanggal = date('d M Y', strtotime($row['tanggal_keberangkatan']));
                        ?>
                        <tr>
                            <td><?php echo ($key + 1); ?></td>
                            <td><?php echo $row['kode_keberangkatan']; ?></td>
                            <td><?php echo $row['nama_paket']; ?></td>
                            <td><?php echo $tanggal; ?></td>
                            <td><?php echo $row['lokasi_keberangkatan']; ?></td>
                            <td><?php echo $row['nama_maskapai']; ?></td>
                            <td><?php echo $row['jumlah_hari']; ?> Hari</td>
                            <td><?php echo $row['kuota_jamaah']; ?> Pax</td>
                            <td><?php echo $row['kuota_terisi']; ?> Pax</td>
                            <td><?php echo $row['sisa_kuota']; ?> Pax</td>
                            <td>
                                <?php if($row['status_paket'] == 'open') { ?>
                                    <span class="badge-open">Open</span>
                                <?php } else { ?>
                                    <span class="badge-closed">Closed</span>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo '<tr><td colspan="11" style="text-align:center;">Tidak ada data</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
